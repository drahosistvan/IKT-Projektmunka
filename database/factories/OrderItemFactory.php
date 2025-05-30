<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hasProducts = Product::count() > 0;
        return [
            'qty' => $this->faker->numberBetween(1, 10),
            'unit_price' => rand(1000, 20000),
            'product_id' => $hasProducts ? Product::inRandomOrder()->first()->id : null,
        ];
    }
}
