<?php

use App\Models\ProductCategory;
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

test('login link is present in inertia props', function () {
    $response = $this->get('/');

    $response->assertInertia(fn ($page) =>
    $page->component('Homepage')
        ->has('auth.user')
    );
    $this->get(route('login'))->assertStatus(200);
});

test('registration link is present in inertia props', function () {
    $response = $this->get('/');

    $response->assertInertia(fn ($page) =>
    $page->component('Homepage')
        ->has('auth.user')
    );
    $this->get(route('register'))->assertStatus(200);
});

test('logout link logs out user', function () {
    $user = Customer::factory()->create();
    $this->actingAs($user);

    $response = $this->post(route('logout'));
    $response->assertRedirect('/');
    $this->assertGuest();
});

test('footer displays visible categories', function () {
    $response = $this->get('/');

    $visibleCategories = ProductCategory::query()->active()->get()->pluck('name')->sort()->values();

    $response->assertInertia(fn ($page) =>
    $page
        ->has('categories')
        ->where('categories', function ($categories) use ($visibleCategories) {
            $names = collect($categories)->pluck('name')->sort()->values();
            return $names->all() === $visibleCategories->all();
        })
    );
});
