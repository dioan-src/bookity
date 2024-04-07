<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $genres = Genre::all();

        $bookGenresData = [];
        foreach($books as $book){
            $numberOfGenres = random_int(1, 5);
            $selectedGenres = ($genres->random($numberOfGenres))->pluck('id');
            
            //format data for bulk insertion
            $bookGenresData = $selectedGenres->map(function ($item) use ($book) {
                return [
                    'book_id' => $book->id, 
                    'genre_id' => $item
                ];
            })->toArray();
            
            // Insert books data into the database using bulk insertion
            DB::table('book_genre')->insert($bookGenresData);
        }
    }
}
