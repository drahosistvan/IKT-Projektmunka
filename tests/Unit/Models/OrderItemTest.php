<?php

use App\Models\Order;
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
    $item = new OrderItem();

    expect($item->getFillable())->toBe([
        'qty',
        'unit_price',
        'product_id',
        'order_id',
    ]);
});

it('belongs to an order', function () {
    $order = Order::factory()->create();
    $item = OrderItem::factory()->create(['order_id' => $order->id]);
    $item->order()->associate($order);

    expect($item->order)->toBeInstanceOf(Order::class);
});
