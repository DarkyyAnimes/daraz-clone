<?php

namespace Database\Factories;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    protected $model = Product::class;
    public function definition()
    {
        return [
            'product_name' => $this->faker->word,
            'product_description' => $this->faker->sentence,
            'product_banner' => $this->faker->imageUrl(),
            'product_instock' => $this->faker->randomElement(['yes', 'no']),
            'product_onsale' => $this->faker->randomElement(['yes', 'no']),
            'product_delivery' => $this->faker->randomElement(['yes', 'no']),
            'product_warranty' => $this->faker->randomElement(['yes', 'no']),
            'category_id' => function () {
                return \App\Models\Category::factory()->create()->id;
            },
            'product_original_price' => $this->faker->randomFloat(2, 10, 500),
            'product_selling_price' => $this->faker->randomFloat(2, 5, 400),
            'product_featured' => $this->faker->randomElement(['yes', 'no']), // 30% chance of being featured
            'product_status' => $this->faker->randomElement(['active', 'inactive']),
            'seller_id' => function () {
                return \App\Models\Seller::factory()->create()->id;
            },
        ];
    }
}
