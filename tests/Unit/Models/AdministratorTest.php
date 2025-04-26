<?php

use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Mockery::close();
});
afterEach(function () {
    Mockery::close();
});

it('has fillable attributes', function () {
    $administrator = new Administrator();

    expect($administrator->getFillable())->toBe(['name', 'email', 'password']);
});

it('hides sensitive attributes', function () {
    $administrator = new Administrator();

    expect($administrator->getHidden())->toBe(['password', 'remember_token']);
});

it('casts attributes', function () {
    $administrator = new Administrator();

    expect($administrator->getCasts())->toBe([
        'id' => 'int',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ]);
});

it('can access panel', function () {
    $administrator = new Administrator();

    expect($administrator->canAccessPanel(new \Filament\Panel()))->toBeTrue();
});
