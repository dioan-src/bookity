<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();
        $countries = Country::all();

        foreach($authors as $author){
            $loop = random_int(1, 2);
            $count = 1;
            while ($count<=$loop) {
                $country = $countries->random();
                $pivotRecord = $author->countries()->where('country_id', $country->id)->first();
                if (!$pivotRecord) {
                    $author->countries()->attach($country->id);
                    $count++;
                }
            }
        }
    }
}
