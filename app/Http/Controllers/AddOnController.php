<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOnRequest;
use Inertia\Inertia;
use App\Models\AddOn;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddOnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AddOn::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/AddOn/Index', [
            'title' => 'Add-Ons',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/AddOn/Create', [
            'title' => 'Create Add-On',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddOnRequest $request)
    {
        $addOn  = new AddOn();
        $addOn->name = $request->addOn;
        $addOn->description = $request->description;
        $addOn->price = $request->price;

        try {
            DB::transaction(function () use ($addOn) {
                $addOn->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/AddOn/Create', [
                'title' => 'Create Add-On',
                'error' => 'Error occurred while creating the add-on. Please try again later.',
            ]);
        }

        $data = AddOn::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/AddOn/Index', [
            'title' => 'Add-On',
            'data' => $data,
            'success' => 'Add-on created successfully',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AddOn $addOn)
    {
        return Inertia::render('Dashboard/AddOn/Edit', [
            'title' => 'Edit Add-On',
            'addOn' => $addOn,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddOnRequest $request, AddOn $addOn)
    {
        $addOn->name = $request->addOn;
        $addOn->description = $request->description;
        $addOn->price = $request->price;

        try {
            DB::transaction(function () use ($addOn) {
                $addOn->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/AddOn/Edit', [
                'title' => 'Edit Add-On',
                'error' => 'Error occurred while updating the add-on. Please try again later.',
            ]);
        }

        $data = AddOn::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/AddOn/Index', [
            'title' => 'Add-On',
            'data' => $data,
            'success' => 'Add-on updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AddOn $addOn)
    {
        $addOn->delete();

        $data = AddOn::orderBy('name', 'asc')->paginate(10);

        $dataArray = [
            'title' => 'Add-On',
            'data' => $data,
            'success' => 'Add-on deleted successfully',
        ];

        return redirect()->route('add-on.index')->with($dataArray);
    }
}
