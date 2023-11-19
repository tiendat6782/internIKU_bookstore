<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'code'=>fake()->currencyCode(),
            'description'=>fake()->text(),
            'giaTri'=>fake()->numberBetween(0,100),
            'status'=>fake()->numberBetween(0,1),
            'start'=>fake()->date(),
            'end'=>fake()->date()
        ];
    }
}
