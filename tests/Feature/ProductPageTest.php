<?php

use App\Models\Product;
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
test('it generates the Product component', function () {
    $product = Product::with('category')->first();

    $response = $this->get(route('product', $product->slug));

    $response->assertStatus(200);

    $response->assertInertia(fn ($page) =>
        $page->component('Product')
    );
});

test('product page renders with correct product, category, and related products', function () {
    $product = Product::with('category')->first();
    $category = $product->category;
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->take(3)
        ->get();

    $response = $this->get(route('product', $product->slug));

    $response->assertStatus(200);

    $response->assertInertia(fn($page) => $page->component('Product')
        ->where('product.id', $product->id)
        ->where('category.id', $category->id)
        ->where('relatedProducts', function ($inertiaProducts) use ($relatedProducts) {
            foreach ($relatedProducts as $related) {
                if (!collect($inertiaProducts)->contains('id', $related->id)) {
                    return false;
                }
            }
            return true;
        })
    );
});
