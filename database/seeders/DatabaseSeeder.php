<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Product;
use App\Models\ProductFeature;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment('local')) {
            Category::factory(5)->create();
            Product::factory(10)->create();
            Feature::factory(10)->create();
            ProductFeature::factory(100)->create();
        }
    }
}
