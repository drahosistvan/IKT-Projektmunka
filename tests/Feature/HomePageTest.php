<?php

// tests/Feature/HomePageTest.php


use App\Models\Product;
use App\Models\Customer;
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

test('it generates the Homepage component', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    $response->assertInertia(fn ($page) =>
    $page->component('Homepage')
    );
});


test('homepage displays categories and products', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    $products = Product::where('featured', true)->take(3)->get();

    $response->assertInertia(fn ($page) =>
    $page
        ->component('Homepage')
        ->where('favorites', function ($favorites) use ($products) {
            // Check that all expected products are present
            foreach ($products as $product) {
                if (!$favorites->contains('id', $product->id)) {
                    return false;
                }
            }
            return true;
        })
    );
});

