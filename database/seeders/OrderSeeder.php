<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()
            ->count(50)
            ->sequence(fn ($sequence) => ['customer_id' => rand(0,1) ? null : Customer::inRandomOrder()->first()->id])
            ->has(OrderItem::factory()->count(rand(2, 5)), 'items')
            ->create();
    }
}
