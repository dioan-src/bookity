<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Support\Carbon;

class BookController extends Controller
{
    private array $bookRelations = ['author','publisher','language','bookType','genres', 'originalBook'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all books from the database
        $books = Book::with($this->bookRelations)->get();

        // Return the books using the resource
        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookRequest $request)
    {
        $book = new Book();
        $book->fill(request()->all());

        $book->save();

        //TODO add book many-to-many relationships i.e. genres

        $book->load($this->bookRelations);

        return BookResource::make($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return BookResource::make($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        foreach (request()->all() as $key => $value) {
            $book->$key = $value;
        }
        
        $book->save();

        //TODO add book many-to-many relationships i.e. genres

        $book->load($this->bookRelations);

        return BookResource::make($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        
        return response()->json(['messages' => 'Book deleted successfully']);
    }
}
