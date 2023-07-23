<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookSynopsis;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookSynopsis>
 */
class BookSynopsisFactory extends Factory
{
    protected $model = BookSynopsis::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => Book::inRandomOrder()->first()->id,
            'synopsis' => fake()->paragraphs(random_int(1, 5),true),
        ];
    }

    
}
