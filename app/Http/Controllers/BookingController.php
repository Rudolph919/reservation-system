<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use Inertia\Inertia;
use App\Models\Booking;
use App\Models\Resource;
use App\Models\ResourceType;
use Illuminate\Http\Request;
use App\Models\BookingStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $bookingStatusId = $request->input('bookingStatusId', '');
        $checkInDate = $request->input('checkInDate', '');
        $checkOutDate = $request->input('checkOutDate', '');

        $query = Booking::with('bookingStatus')->orderBy('check_in_date', 'asc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('guest_name', 'LIKE', "%{$search}%");
        }

        if ($request->filled('bookingStatusId')) {
            $bookingStatusId = $request->input('bookingStatusId');
            $query->where('booking_status_id', $bookingStatusId);
        }

        if ($request->filled('checkInDate') && $request->filled('checkOutDate')) {
            $checkInDate = $request->input('checkInDate');
            $checkOutDate = $request->input('checkOutDate');
            $query->whereBetween('booking_date', [$checkInDate, $checkOutDate]);
        }

        $data = $query->paginate(10);
        $bookingStatus = BookingStatus::all();

        return Inertia::render('Dashboard/Booking/Index', [
            'title' => 'Booking',
            'data' => $data,
            'bookingStatus' => $bookingStatus,
            'search' => $search,
            'bookingStatusId' => $bookingStatusId,
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
        ]);
    }

    public function show(Booking $booking)
    {
        $booking->load(['bookingStatus', 'resource']);

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
    public function store(StoreBookingRequest $request)
    {
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

        $dataArray = [
            'title' => 'Booking',
            'data' => $data,
            'success' => 'Booking deleted successfully',
        ];

        return redirect()->route('booking.index')->with($dataArray);
    }

}
