<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Bögrék',
            'Táskák',
            'Jegyzetfüzetek',
            'Tárolók',
        ];

        foreach ($categories as $category) {
            \App\Models\ProductCategory::factory()->create([
                'name' => $category,
                'slug' => \Illuminate\Support\Str::slug($category),
                'description' => 'Ez a(z) ' . $category . ' kategória leírása.',
                'seo_title' => $category . ' kategória',
                'seo_description' => 'Ez a(z) ' . $category . ' kategória leírása.',
                'is_visible' => !($category == 'Bögrék'),
            ]);
        }
    }
}
