<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedCategories();
        $this->seedLocations();
    }

    private function seedCategories(): void
    {
        $response = Http::get(config('services.adzuna.url'), [
            'app_id' => config('services.adzuna.app_id'),
            'app_key' => config('services.adzuna.app_key'),
            'content-type' => 'application/json',
        ]);

        if ($response->successful()) {
            $categories = $response->json()['results'];
            $categoryData = array_map(function ($category) {
                return [
                    'category_name' => $category['label'],
                    'slug' => $category['tag'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $categories);

            Category::insert($categoryData);
            $this->command->info('Categories stored successfully!');
        } else {
            $this->command->error('Failed to fetch categories from the API: ' . $response->body());
        }
    }

    private function seedLocations(): void
    {
        $response = Http::get('https://bdapis.com/api/v1.2/districts');

        if ($response->successful()) {
            $locations = $response->json()['data'];
            $locationData = array_map(function ($location) {
                return [
                    'location_name_en' => $location['district'],
                    'location_name_bn' => $location['districtbn'],
                    'slug' => Str::slug($location['district']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $locations);

            Location::insert($locationData);
            $this->command->info('Locations stored successfully!');
        } else {
            $this->command->error('Failed to fetch locations from the API: ' . $response->body());
        }
    }
}
