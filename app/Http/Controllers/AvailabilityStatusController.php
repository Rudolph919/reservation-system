<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailabilityStatusRequest;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\AvailabilityStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class AvailabilityStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AvailabilityStatus::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/AvailabilityStatus/Index', [
            'title' => 'Availability Status',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/AvailabilityStatus/Create', [
            'title' => 'Create Availability Status',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AvailabilityStatusRequest $request): Response
    {
        $availabilityStatus = new AvailabilityStatus();
        $availabilityStatus->name = $request->availabilityStatus;

        try {
            DB::transaction(function () use ($availabilityStatus) {
                $availabilityStatus->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/AvailabilityStatus/Create', [
                'title' => 'Create Availability Status',
                'error' => 'Error occurred while creating the availability status. Please try again later.',
            ]);
        }

        $data = AvailabilityStatus::orderBy('name', 'asc')->paginate(10);

        return Inertia::render('Dashboard/AvailabilityStatus/Index', [
            'title' => 'Availability Status',
            'data' => $data,
            'success' => 'Availability Status created successfully',
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AvailabilityStatus $availabilityStatus): Response
    {
        return Inertia::render('Dashboard/AvailabilityStatus/Edit', [
            'title' => 'Edit Availability Status',
            'availabilityStatus' => $availabilityStatus,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(AvailabilityStatusRequest $request, string $id)
    {
        $availabilityStatus = AvailabilityStatus::find($id);
        $availabilityStatus->name = $request->availabilityStatus;

        try {
            DB::transaction(function () use ($availabilityStatus) {
                $availabilityStatus->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/AvailabilityStatus/', [
                'title' => 'Edit Availability Status',
                'error' => 'Error occurred while updating the availability status. Please try again later.',
            ]);
        }

        $data = AvailabilityStatus::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/AvailabilityStatus/Index', [
            'title' => 'Availability Status',
            'data' => $data,
            'success' => 'Availability Status updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AvailabilityStatus $availabilityStatus): RedirectResponse
    {
        $availabilityStatus->delete();

        $data = AvailabilityStatus::orderBy('name', 'asc')->paginate(10);

        $dataArray = [
            'title' => 'Availability Status',
            'data' => $data,
            'success' => 'Availability Status deleted successfully',
        ];

        return redirect()->route('availability-status.index')->with($dataArray);
    }
}
