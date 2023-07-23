<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BookTypeSeeder::class,
            LanguageSeeder::class,
            CountrySeeder::class,
            GenreSeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
            BookGenreSeeder::class,
            BookSynopsisSeeder::class,
            BookLanguageSeeder::class,
            UserSeeder::class
        ]);
    }
}
