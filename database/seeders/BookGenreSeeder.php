<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $genres = Genre::all();

        foreach($books as $book){
            $loop = random_int(1, 5);
            $count = 1;
            while ($count<=$loop) {
                $genre = $genres->random();
                $pivotRecord = $book->genres()->where('genre_id', $genre->id)->first();
                if (!$pivotRecord) {
                    $book->genres()->attach($genre->id);
                    $count++;
                }
            }
        }
    }
}
