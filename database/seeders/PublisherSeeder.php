<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publishers = [];

        for ($i = 0; $i < 75; $i++) {
            $publishers[] = [
                'name' => ucwords(fake()->words(random_int(1, 3), true))
            ];
        }

        // Insert v data into the database using bulk insertion
        DB::table('publishers')->insert($publishers);
    }
}
