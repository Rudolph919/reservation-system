<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use Faker\Factory as FakerFactory;
use Inertia\Inertia;
use App\Models\Resource;
use App\Models\ResourceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Resource::with('resourceType')->orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/Resource/Index', [
            'title' => 'Resources',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/Resource/Create', [
            'title' => 'Create Resource',
            'resourceTypes' => ResourceType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResourceRequest $request)
    {
        //TODO: Need to remove this when image uploads have been completed
        $faker = FakerFactory::create();

        $resource = new Resource();
        $resource->name = $request->resource;
        $resource->description = $request->description;
        $resource->resource_type_id = $request->resourceTypeId;
        $resource->capacity = $request->capacity;
        $resource->price = $request->price;
        $resource->location = $request->location;
        $resource->image = $faker->imageUrl(640, 480);

        try {
            DB::transaction(function () use ($resource) {
                $resource->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/Resource/Create', [
                'title' => 'Create Resource',
                'error' => 'Error occurred while creating the resource. Please try again later.',
            ]);
        }

        $data = Resource::with('resourceType')->orderBy('name', 'asc')->paginate(10);
        return Inertia::render('Dashboard/Resource/Index', [
            'title' => 'Resource',
            'data' => $data,
            'success' => 'Resource created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        return Inertia::render('Dashboard/Resource/Edit', [
            'title' => 'Edit Resource',
            'resource' => $resource,
            'resourceTypes' => ResourceType::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResourceRequest $request, Resource $resource)
    {
        $resource->name = $request->resource;
        $resource->description = $request->description;
        $resource->resource_type_id = $request->resourceTypeId;
        $resource->capacity = $request->capacity;
        $resource->price = $request->price;
        $resource->location = $request->location;

        try {
            DB::transaction(function () use ($resource) {
                $resource->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return Inertia::render('Dashboard/Resource/Edit', [
                'title' => 'Edit Resource',
                'error' => 'Error occurred while updating the add-on. Please try again later.',
                'resourceTypes' => ResourceType::all(),
            ]);
        }

        $data = Resource::with('resourceType')->orderBy('name', 'asc')->paginate(20);
        return Inertia::render('Dashboard/Resource/Index', [
            'title' => 'Resource',
            'data' => $data,
            'success' => 'Resource updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();

        $data = Resource::with('resourceType')->orderBy('name', 'asc')->paginate(10);

        $dataArray = [
            'title' => 'Resource',
            'data' => $data,
            'success' => 'Resource deleted successfully',
        ];

        return redirect()->route('resource.index')->with($dataArray);
    }
}
