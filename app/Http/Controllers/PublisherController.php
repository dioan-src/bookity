<?php

namespace App\Http\Controllers;

use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    private array $publisherRelations = ['books'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all publishers from the database
        $publishers = Publisher::with($this->publisherRelations)->get();

        // Return the publishers using the resource
        return PublisherResource::collection($publishers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //TODO
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        return PublisherResource::make($publisher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        //TODO
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();

        return response()->json(['messages' => 'Publisher deleted successfully']);
    }
}
