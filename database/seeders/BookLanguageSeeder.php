<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalBooks = Book::count();
        //get a random amount of book
        $books = Book::inRandomOrder()->limit(random_int((int)($totalBooks*(3/4)), $totalBooks))->get();
        //get all languages
        $languages = Language::all();

        foreach($books as $book){
            $loop = random_int(1, 2);
            $count = 1;
            while ($count<=$loop) {
                $language = $languages->random();
                $pivotRecord = $book->languages()->where('language_id', $language->id)->first();
                if (!$pivotRecord) {
                    $book->languages()->attach($language->id);
                    $count++;
                }
            }
        }
    }
}
