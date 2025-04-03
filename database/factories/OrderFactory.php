<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->safeEmail(),
            'billing_name' => strtolower($this->faker->name()),
            'billing_country' => strtolower($this->faker->countryCode()),
            'billing_street' => $this->faker->streetAddress(),
            'billing_city' => $this->faker->city(),
            'billing_zip' => $this->faker->postcode(),
            'shipping_name' => strtolower($this->faker->name()),
            'shipping_country' => strtolower($this->faker->countryCode()),
            'shipping_street' => $this->faker->streetAddress(),
            'shipping_city' => $this->faker->city(),
            'shipping_zip' => $this->faker->postcode(),
            'total_price' => rand(1000, 20000),
            'status' => $this->faker->randomElement(['new', 'processing', 'shipped', 'delivered', 'cancelled']),
            'shipping_price' => 2000,
            'notes' => $this->faker->realText(100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
