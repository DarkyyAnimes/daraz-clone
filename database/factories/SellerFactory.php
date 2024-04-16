<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seller::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_name' => $this->faker->company,
            'store_email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Default password, change this according to your password policy
            'store_phone_no' => $this->faker->phoneNumber,
            'isfeatured' => $this->faker->randomElement(['yes', 'no']),
            'store_address' => $this->faker->address,
            'store_image_path' => $this->faker->imageUrl(),
            'store_logo' => $this->faker->imageUrl(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}
