<?php

namespace Database\Seeders;

use App\Models\BookType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/booktypes.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                BookType::create([
                    "name" => $data['0'],
                ]);
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
