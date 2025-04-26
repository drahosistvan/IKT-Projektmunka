<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->words(3, true),
            'slug' => \Illuminate\Support\Str::slug($name),
            'sku' => $this->faker->unique()->ean8(),
            'barcode' => $this->faker->ean13(),
            'category_id' => ProductCategory::inRandomOrder()->first()->id,
            'description' => $this->faker->realText(),
            'qty' => $this->faker->randomDigitNotNull(),
            'featured' => false,
            'is_visible' => $this->faker->boolean(),
            'old_price' => $this->faker->randomFloat(2, 100, 500),
            'price' => $this->faker->randomFloat(2, 80, 400),
            'cost' => $this->faker->randomFloat(2, 50, 200),
            'published_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }

    public function configure(): ProductFactory
    {
        return $this->afterCreating(function (\App\Models\Product $product) {
            try {
                $product
                    ->addMediaFromString(File::get(database_path('seeders/images/' . $product->slug . '.jpg')))
                    ->usingFileName($product->slug . '.jpg')
                    ->toMediaCollection('product-images');
            } catch (\Exception $exception) {
                return;
            }
        });
    }
}
