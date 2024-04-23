<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private array $authorRelations = ['books'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all authors from the database
        $authors = Author::with($this->authorRelations)->get();

        // Return the authors using the resource
        return AuthorResource::collection($authors);
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
    public function show(Author $author)
    {
        return AuthorResource::make($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        //TODO
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(['messages' => 'Author deleted successfully']);
    }
}
