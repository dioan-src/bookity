<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $languages = Language::all();

        $bookLanguageData = [];
        foreach($books as $book){
            $numberOfLanguages = random_int(1, 4);
            $selectedLanguages = $languages->random($numberOfLanguages)->pluck('id');

            //format data for bulk insertion
            $bookLanguageData = $selectedLanguages->map(function ($item) use ($book) {
                return [
                    'book_id' => $book->id, 
                    'language_id' => $item
                ];
            })->toArray();

            DB::table('book_language')->insert($bookLanguageData);
        }
    }
}
