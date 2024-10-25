<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch data from the API
        $response = Http::get('https://bdapis.com/api/v1.2/districts');
        if ($response->successful()) {
            $locations = $response->json();

            foreach ($locations['data'] as $location) {
                // Insert location data into the database
                Location::Create([
                    'location_name_en' =>  $location['district'],
                    'location_name_bn' => $location['districtbn'],
                    'slug' =>  Str::slug($location['district']),
                ]);
            }

            $this->command->info('Locations stored successfully!');
        } else {
            $this->command->error('Failed to fetch locations from the API.');
        }
    }
}
