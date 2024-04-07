<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/genres.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Genre::create([
                    "name" => $data['0'],
                ]);
            }
            $firstline = false;
        }
   
        fclose($csvFile);

        $csvFile = fopen(base_path("database/data/genres.csv"), "r");

        // Initialize an array to store genres data
        $genres = [];
  
        // Skip the first line (header) of the CSV file
        fgetcsv($csvFile);

        // Read each line of the CSV file and add genres data to the array
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            $genres[] = [
                "name" => $data[0]
            ];
        }

        // Close the CSV file
        fclose($csvFile);

        // Insert genres data into the database using bulk insertion
        DB::table('genres')->insert($genres);
    }
}
