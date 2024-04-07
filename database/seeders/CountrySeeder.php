<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/countries.csv"), "r");

        // Initialize an array to store countries data
        $countries = [];
  
        // Skip the first line (header) of the CSV file
        fgetcsv($csvFile);

        // Read each line of the CSV file and add countries data to the array
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            $countries[] = [
                "name" => $data[0]
            ];
        }

        // Close the CSV file
        fclose($csvFile);

        // Insert countries data into the database using bulk insertion
        DB::table('countries')->insert($countries);
    }
}
