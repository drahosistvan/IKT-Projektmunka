<?php

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Mockery::close();
});
afterEach(function () {
    Mockery::close();
});

it('has fillable attributes', function () {
    $customer = new Customer();

    expect($customer->getFillable())->toBe([
        'name',
        'email',
        'password',
        'phone',
        'billing_country',
        'billing_street',
        'billing_city',
        'billing_zip',
        'shipping_country',
        'shipping_street',
        'shipping_city',
        'shipping_zip',
    ]);
});

it('hides sensitive attributes', function () {
    $customer = new Customer();

    expect($customer->getHidden())->toBe(['password', 'remember_token']);
});
