<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Laptop']);
        Category::create(['name' => 'Projector']);
        Category::create(['name' => 'Camera']);
        Category::create(['name' => 'Accessories', 'description' => 'Various accessories']);
    }
}
