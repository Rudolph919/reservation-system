<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
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
        $data = AddOn::orderBy('name', 'asc')->paginate(2);
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'addOn' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|max:255',
        ]);

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

        $data = AddOn::orderBy('name', 'asc')->paginate(2);
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
    public function update(Request $request, AddOn $addOn)
    {
        $validated = $request->validate([
            'addOn' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|max:255',
        ]);

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

        $data = AddOn::orderBy('name', 'asc')->paginate(2);
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

        $data = AddOn::orderBy('name', 'asc')->paginate(2);
        return Inertia::render('Dashboard/AddOn/Index', [
            'title' => 'Add-On',
            'data' => $data,
            'success' => 'Add-on deleted successfully',
        ]);
    }
}
