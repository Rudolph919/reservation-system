<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStatusRequest;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\BookingStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BookingStatus::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/BookingStatus/Index', [
            'title' => 'Booking Status',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/BookingStatus/Create', [
            'title' => 'Create Booking Status',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingStatusRequest $request)
    {
        $bookingStatus  = new BookingStatus();
        $bookingStatus->name = $request->bookingStatus;

        try {
            DB::transaction(function () use ($bookingStatus) {
                $bookingStatus->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/BookingStatus/Create', [
                'title' => 'Create Booking Status',
                'error' => 'Error occurred while creating the booking status. Please try again later.',
            ]);
        }

        $data = BookingStatus::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/BookingStatus/Index', [
            'title' => 'Booking Status',
            'data' => $data,
            'success' => 'Booking Status created successfully',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingStatus $bookingStatus)
    {
        return Inertia::render('Dashboard/BookingStatus/Edit', [
            'title' => 'Edit Booking Status',
            'bookingStatus' => $bookingStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingStatusRequest $request, string $id)
    {
        $bookingStatus = BookingStatus::find($id);
        $bookingStatus->name = $request->bookingStatus;

        try {
            DB::transaction(function () use ($bookingStatus) {
                $bookingStatus->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/BookingStatus/Edit', [
                'title' => 'Edit Booking Status',
                'error' => 'Error occurred while updating the booking status. Please try again later.',
            ]);
        }

        $data = BookingStatus::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/BookingStatus/Index', [
            'title' => 'Booking Status',
            'data' => $data,
            'success' => 'Booking Status updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingStatus $bookingStatus)
    {
        $bookingStatus->delete();

        $data = BookingStatus::orderBy('name', 'asc')->paginate(10);

        $dataArray = [
            'title' => 'Booking Status',
            'data' => $data,
            'success' => 'Booking Status deleted successfully',
        ];

        return redirect()->route('booking-status.index', $dataArray);
    }
}
