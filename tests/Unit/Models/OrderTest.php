<?php

use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Mockery::close();
});
afterEach(function () {
    Mockery::close();
});

it('has fillable attributes', function () {
    $order = new Order();

    expect($order->getFillable())->toBe([
        'number',
        'email',
        'status',
        'customer_id',
        'billing_name',
        'billing_country',
        'billing_street',
        'billing_city',
        'billing_zip',
        'shipping_name',
        'shipping_country',
        'shipping_street',
        'shipping_city',
        'shipping_zip',
        'total_price',
        'shipping_price',
        'shipping_method',
        'notes',
    ]);
});

it('belongs to a customer', function () {
    $order = Order::factory()->create();
    $customer = Customer::factory()->create();
    $order->customer()->associate($customer);
    $order->save();

    expect($order->customer)->toBeInstanceOf(Customer::class);
});

it('has many items', function () {
    $order = Order::factory()->create();
    $item = OrderItem::factory()->create(['order_id' => $order->id]);
    $order->items()->save($item);

    expect($order->items->pluck('id'))->toContain($item->id);
});
