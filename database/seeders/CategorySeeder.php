<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch data from the API
        $response = Http::get('http://api.adzuna.com/v1/api/jobs/gb/categories?app_id=bb4a97fa&app_key=c48de471773a0c75f39ebdae2b53c34a&&content-type=application/json');
        if ($response->successful()) {
            $categories = $response->json();

            foreach ($categories['results'] as $category) {
                // Insert categories data into the database
                Category::Create([
                    'category_name' =>  $category['label'],
                    'slug' =>  $category['tag'],
                ]);
            }

            $this->command->info('Categories stored successfully!');
        } else {
            $this->command->error('Failed to fetch locations from the API.');
        }
    }
}
