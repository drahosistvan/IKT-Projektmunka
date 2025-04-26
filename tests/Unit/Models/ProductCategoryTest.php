<?php

use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Mockery::close();
});
afterEach(function () {
    Mockery::close();
});

it('has fillable attributes', function () {
    $category = new ProductCategory();

    expect($category->getFillable())->toBe([
        'name',
        'slug',
        'is_visible',
        'description',
    ]);
});

it('casts is_visible to boolean', function () {
    $category = ProductCategory::factory()->create(['is_visible' => 1]);
    expect($category->is_visible)->toBeTrue();

    $category = ProductCategory::factory()->create(['is_visible' => 0]);
    expect($category->is_visible)->toBeFalse();
});

it('has many products', function () {
    $category = ProductCategory::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    expect($category->products->pluck('id'))->toContain($product->id);
});

it('scope active returns only visible categories', function () {
    $visible = ProductCategory::factory()->create(['is_visible' => true]);
    ProductCategory::factory()->create(['is_visible' => false]);

    $activeCategories = ProductCategory::query()->active()->get();

    expect($activeCategories)->toHaveCount(1)
        ->and($activeCategories->first()->id)->toBe($visible->id);
});
