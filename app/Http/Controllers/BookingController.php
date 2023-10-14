<?php

namespace App\Http\Controllers;

use App\Models\BookingStatus;
use Inertia\Inertia;
use App\Models\Booking;
use App\Models\Resource;
use App\Models\ResourceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function search()
    {
        return Inertia::render('BookingPage', [
            'title' => 'Booking',
            'resourceTypes' => ResourceType::all(),
        ]);
    }

    public function searchBookings(Request $request)
    {
        $searchCriteria = $request->form;

        if (!empty($searchCriteria['checkInDate'])) {
            $checkInDate = $searchCriteria['checkInDate'];
        } else {
            $checkInDate = '';
        }

        $checkOutDate = $searchCriteria['checkOutDate'] ?? null;
        $selectedResourceType = $searchCriteria['selectedResourceType'] ?? null;

        if (isset($checkInDate) && isset($checkOutDate) && $checkInDate > $checkOutDate) {
            return Inertia::render('BookingPage', [
                'error' => 'Check-in date must be before check-out date',
            ]);
        }

        if (
            (empty($checkInDate) && empty($checkOutDate)) || // Both dates are null
            (!empty($checkInDate) && !empty($checkOutDate))    // Both dates have values
        ) {

            $filteredBookings = Booking::with('resource')
                ->where(function ($query) use ($checkInDate, $checkOutDate, $selectedResourceType) {
                    // Check-in Date
                    if ($checkInDate) {
                        $query->where('check_in_date', '>=', $checkInDate);
                    }

                    // Check-out Date
                    if ($checkOutDate) {
                        $query->where('check_out_date', '<=', $checkOutDate);
                    }

                    // Resource Type
                    if ($selectedResourceType) {
                        $query->whereHas('resource', function ($resourceQuery) use ($selectedResourceType) {
                            $resourceQuery->where('resource_type_id', $selectedResourceType);
                        });
                    }
                })->paginate(10);

            return Inertia::render('BookingPage', [
                'filteredBookings' => $filteredBookings,
                'resourceTypes' => ResourceType::all(),
            ]);//


        } else {
            return Inertia::render('BookingPage', [
                'error' => 'Both check-in and check-out dates must be either null or have values',
                'resourceTypes' => ResourceType::all(),
            ]);// Dates are not valid
        }
    }

    public function index()
    {
        $data = Booking::with('bookingStatus')->orderBy('check_in_date', 'asc')->paginate(20);
        return Inertia::render('Dashboard/Booking/Index', [
            'title' => 'Booking',
            'data' => $data
        ]);
    }

    public function show(Booking $booking)
    {
        $booking->load('resource');

        return Inertia::render('Dashboard/Booking/Show', [
            'title' => 'Booking',
            'booking' => $booking
        ]);
    }

    public function create()
    {
        return Inertia::render('Dashboard/Booking/Create', [
            'title' => 'Create Booking',
            'resource' => Resource::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'checkInDate' => 'required|date',
            'checkOutDate' => 'required|date',
            'resourceId' => 'required|exists:resources,id',
            'guestName' => 'required|max:255',
            'guestEmail' => 'required|email|max:255',
            'guestPhone' => 'required|max:255',
            'guestCount' => 'required|numeric|min:1',
        ]);

        $booking = new Booking();
        $booking->check_in_date = $request->checkInDate;
        $booking->check_out_date = $request->checkOutDate;
        $booking->resource_id = $request->resourceId;
        $booking->guest_name = $request->guestName;
        $booking->guest_email = $request->guestEmail;
        $booking->guest_phone = $request->guestPhone;
        $booking->guest_count = $request->guestCount;
        $booking->booking_status_id = 1;

        $resource = Resource::find($request->resourceId);
        $booking->total_price = $resource->price * $request->guestCount;

        try {
            DB::transaction(function () use ($booking) {
                $booking->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/Booking/Create', [
                'title' => 'Create Booking',
                'error' => 'Error occurred while creating the booking. Please try again later.',
            ]);
        }

        $data = Booking::with('bookingStatus')->orderBy('check_in_date', 'asc')->paginate(20);
        return Inertia::render('Dashboard/Booking/Index', [
            'title' => 'Booking',
            'data' => $data,
            'success' => 'Booking created successfully',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return Inertia::render('Dashboard/Booking/Edit', [
            'title' => 'Edit Booking',
            'booking' => $booking,
            'bookingStatuses' => BookingStatus::all(),
            'resource' => Resource::all(),
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        $data = Booking::with('bookingStatus')->orderBy('check_in_date', 'asc')->paginate(20);
        return Inertia::render('Dashboard/Booking/Index', [
            'title' => 'Booking',
            'data' => $data,
            'success' => 'Booking deleted successfully',
        ]);
    }


}

