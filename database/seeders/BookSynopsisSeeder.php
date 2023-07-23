<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookSynopsis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSynopsisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //get all books
        $books = Book::inRandomOrder()->get();
        //set flag stopper for while
        $flagStop = random_int(1, Book::count());
        //set counter
        $counter = 1;
        while( $counter <= $flagStop ){
            BookSynopsis::factory()->create([
                'book_id' => $books->skip($counter-1)->take(1)->first()->id
            ]);
            $counter++;
        }
    }
}
