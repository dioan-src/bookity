<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookType;
use App\Models\Language;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
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
