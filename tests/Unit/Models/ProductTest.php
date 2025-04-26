<?php

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Mockery::close();
});
afterEach(function () {
    Mockery::close();
});

it('has fillable attributes', function () {
    $product = new Product();

    expect($product->getFillable())->toBe([
        'name',
        'slug',
        'sku',
        'barcode',
        'category_id',
        'description',
        'qty',
        'featured',
        'is_visible',
        'old_price',
        'price',
        'cost',
        'published_at',
        'seo_title',
        'seo_description',
        'weight',
        'height',
        'width',
        'depth',
    ]);
});

it('casts attributes correctly', function () {
    ProductCategory::factory()->create(['is_visible' => true]);
    $product = Product::factory()->create([
        'featured' => 1,
        'is_visible' => 1,
        'price' => 1234,
        'old_price' => 2345,
        'cost' => 345,
        'published_at' => '2024-01-01',
    ]);

    expect($product->featured)->toBeTrue()
        ->and($product->is_visible)->toBeTrue()
        ->and($product->price)->toBeInt()
        ->and($product->old_price)->toBeInt()
        ->and($product->cost)->toBeInt()
        ->and($product->published_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
});

it('belongs to a category', function () {
    $category = ProductCategory::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    expect($product->category)->toBeInstanceOf(ProductCategory::class);
});

it('returns formatted price', function () {
    ProductCategory::factory()->create(['is_visible' => true]);
    $product = Product::factory()->create(['price' => 123456]);
    expect($product->formatted_price)->toBe('123 456 Ft');
});

it('returns main image url', function () {
    ProductCategory::factory()->create(['is_visible' => true]);
    $product = Product::factory()->create();
    // By default, no media is attached, so it should return an empty string
    expect($product->main_image)->toBe('');
});
