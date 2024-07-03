<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'company_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'product_name' => $this->faker->realText(10),
            'price' => $this->faker->numberBetween($min = 50, $max = 250),
            'stock' => $this->faker->numberBetween($min = 3, $max = 50),
            'comment' => $this->faker->realText(50),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
