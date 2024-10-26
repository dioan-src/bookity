<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\BookType;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_first_try(): void
    {
        $this->assertCount(2, ['ha', 'ho']);
    }

    public function test_book_type_creation()
    {
        // Create a BookType instance using the factory
        $bookType = BookType::factory()->create();

        // Assert that the BookType exists in the database
        $this->assertDatabaseHas('book_types', [
            'id' => $bookType->id,
            'name' => $bookType->name,
        ]);
    }

    public function test_multiple_book_types_creation()
    {
        // Create multiple BookType instances
        $bookTypes = BookType::factory()->count(5)->create();

        // Assert that the correct number of BookTypes were created
        $this->assertCount(5, $bookTypes);

        // Assert each BookType exists in the database
        foreach ($bookTypes as $bookType) {
            $this->assertDatabaseHas('book_types', [
                'id' => $bookType->id,
                'name' => $bookType->name,
            ]);
        }
    }

    public function test_country_creation()
    {
        // Create a Country instance using the factory
        $country = Country::factory()->create();

        // Assert that the Country exists in the database
        $this->assertDatabaseHas('countries', [
            'id' => $country->id,
            'name' => $country->name,
        ]);
    }

    public function test_multiple_countries_creation()
    {
        // Create multiple Country instances
        $countries = Country::factory()->count(5)->create();

        // Assert that the correct number of Countries were created
        $this->assertCount(5, $countries);

        // Assert each Country exists in the database
        foreach ($countries as $country) {
            $this->assertDatabaseHas('countries', [
                'id' => $country->id,
                'name' => $country->name,
            ]);
        }
    }

    public function test_genre_creation()
    {
        // Create a Genre instance using the factory
        $genre = Genre::factory()->create();

        // Assert that the Genre exists in the database
        $this->assertDatabaseHas('genres', [
            'id' => $genre->id,
            'name' => $genre->name,
        ]);
    }

    public function test_multiple_genres_creation()
    {
        // Create multiple Genre instances
        $genres = Genre::factory()->count(5)->create();

        // Assert that the correct number of Genres were created
        $this->assertCount(5, $genres);

        // Assert each Genre exists in the database
        foreach ($genres as $genre) {
            $this->assertDatabaseHas('genres', [
                'id' => $genre->id,
                'name' => $genre->name,
            ]);
        }
    }

    public function test_language_creation()
    {
        // Create a Language instance using the factory
        $language = Language::factory()->create();

        // Assert that the Language exists in the database
        $this->assertDatabaseHas('languages', [
            'id' => $language->id,
            'name' => $language->name,
        ]);
    }

    public function test_multiple_languages_creation()
    {
        // Create multiple Language instances
        $languages = Language::factory()->count(5)->create();

        // Assert that the correct number of Languages were created
        $this->assertCount(5, $languages);

        // Assert each Language exists in the database
        foreach ($languages as $language) {
            $this->assertDatabaseHas('languages', [
                'id' => $language->id,
                'name' => $language->name,
            ]);
        }
    }
}
