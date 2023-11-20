<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceTypeRequest;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\ResourceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResourceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ResourceType::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/ResourceType/Index', [
            'title' => 'Resource Type',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/ResourceType/Create', [
            'title' => 'Create Resource Type'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResourceTypeRequest $request): Response
    {
        $resourceType  = new ResourceType();
        $resourceType->name = $request->resourceType;

        try {
            DB::transaction(function () use ($resourceType) {
                $resourceType->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/ResourceType/Create', [
                'title' => 'Create Resource Type',
                'error' => 'Error occurred while creating the resource type. Please try again later.',
            ]);
        }

        $data = ResourceType::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/ResourceType/Index', [
            'title' => 'Resource Type',
            'data' => $data,
            'success' => 'Resource Type created successfully',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResourceType $resourceType)
    {
        return Inertia::render('Dashboard/ResourceType/Edit', [
            'title' => 'Edit Resource Type',
            'resourceType' => $resourceType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResourceTypeRequest $request, string $id)
    {
        $resourceType = ResourceType::find($id);
        $resourceType->name = $request->resourceType;

        try {
            DB::transaction(function () use ($resourceType) {
                $resourceType->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/ResourceType/Edit', [
                'title' => 'Edit Resource Type',
                'error' => 'Error occurred while updating the availability status. Please try again later.',
            ]);
        }

        $data = ResourceType::orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/ResourceType/Index', [
            'title' => 'Resource Type',
            'data' => $data,
            'success' => 'Resource Type updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResourceType $resourceType)
    {
        $resourceType->delete();

        $data = ResourceType::orderBy('name', 'asc')->paginate(10);

        $dataArray = [
            'title' => 'Resource Type',
            'data' => $data,
            'success' => 'Resource type deleted successfully',
        ];

        return redirect()->route('resource-type.index')->with($dataArray);
    }
}
