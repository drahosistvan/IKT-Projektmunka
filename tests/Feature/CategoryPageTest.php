<?php

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Mockery::close();
    $this->seed([
        \Database\Seeders\ProductCategorySeeder::class,
        \Database\Seeders\ProductSeeder::class,
        \Database\Seeders\PageSeeder::class,
    ]);
});

afterEach(function () {
    Mockery::close();
});

test('it generates the Category component', function () {
    $category = ProductCategory::query()->active()->first();
    $products = Product::where('category_id', $category->id)->get();

    $response = $this->get(route('category', $category->slug));

    $response->assertStatus(200);

    $response->assertInertia(fn ($page) =>
        $page->component('Category')
    );
});

test('category page renders with correct category and products', function () {
    $category = ProductCategory::query()->active()->first();
    $products = Product::where('category_id', $category->id)->get();

    $response = $this->get(route('category', $category->slug));

    $response->assertStatus(200);

    $response->assertInertia(fn ($page) =>
    $page->component('Category')
        ->where('category.id', $category->id)
        ->where('category.name', $category->name)
        ->where('products', function ($inertiaProducts) use ($products) {
            // Check that all expected products are present
            foreach ($products as $product) {
                if (!collect($inertiaProducts)->contains('id', $product->id)) {
                    return false;
                }
            }
            return true;
        })
    );
});
