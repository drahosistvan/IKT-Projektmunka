<?php

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Mockery::close();
});
afterEach(function () {
    Mockery::close();
});

it('has fillable attributes', function () {
    $page = new Page();

    expect($page->getFillable())->toBe([
        'title',
        'slug',
        'content',
        'is_visible',
        'seo_title',
        'seo_description',
    ]);
});

it('casts is_visible to boolean', function () {
    $page = Page::factory()->create(['is_visible' => 1]);
    expect($page->is_visible)->toBeTrue();

    $page = Page::factory()->create(['is_visible' => 0]);
    expect($page->is_visible)->toBeFalse();
});
