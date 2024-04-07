<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [];

        for ($i = 0; $i < 400; $i++) {
            $authors[] = [
                'name' => fake()->firstName(),
                'surname' => fake()->lastName()
            ];
        }

        // Insert authors data into the database using bulk insertion
        DB::table('authors')->insert($authors);
    }
}
