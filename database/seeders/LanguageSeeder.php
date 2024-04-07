<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/languages.csv"), "r");

        // Initialize an array to store language data
        $languages = [];
  
        // Skip the first line (header) of the CSV file
        fgetcsv($csvFile);

        // Read each line of the CSV file and add language data to the array
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            $languages[] = [
                "name" => $data[0]
            ];
        }

        // Close the CSV file
        fclose($csvFile);

        // Insert language data into the database using bulk insertion
        DB::table('languages')->insert($languages);
    }
}
