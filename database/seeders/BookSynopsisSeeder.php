<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookSynopsis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $counter = 1; $bookSynopsisData = [];
        foreach($books as $book){
            $bookSynopsisData[] = [
                'book_id' => $book->id,
                'synopsis' => fake()->paragraphs(random_int(1, 5),true),
                ];
            $counter++;
            if($counter>=$flagStop) break;
        }

        DB::table('book_synopses')->insert($bookSynopsisData);
    }
}
