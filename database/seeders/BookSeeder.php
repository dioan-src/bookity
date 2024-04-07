<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\BookType;
use App\Models\Language;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //generate first edition books
        $this->createBooksInBulk(750);

        //generate second edition books (original_book_id will not be null)
        $this->createBooksInBulk(50);
    }

    /**
     * Generate books in bulk.
     */
    public function createBooksInBulk(int $number): void
    {
        $books = [];

        //generate number of books
        for ($i = 0; $i < $number; $i++) {
            $books[] = $this->generateBook();
        }

        // Insert books data into the database using bulk insertion
        DB::table('books')->insert($books);
    }

    /**
     * Generate single Book.
     */
    public function generateBook(): array
    {
        return [
        'title' => fake()->sentence(random_int(2, 8)),
        'isbn' => fake()->unique()->isbn13(),
        'author_id' => Author::inRandomOrder()->first()->id,
        'publisher_id' => Publisher::inRandomOrder()->first()->id,
        'published_at' => fake()->dateTimeBetween(),
        'language_id' => Language::inRandomOrder()->first()->id,
        'book_type_id' => BookType::inRandomOrder()->first()->id,
        'pages' => fake()->numberBetween(100,900),
        'original_book_id' => optional(fake()->boolean(10), function () {
            return Book::inRandomOrder()->first()?->id;
            })
        ];
    }
}
