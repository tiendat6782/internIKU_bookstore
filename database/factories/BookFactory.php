<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Readline\Hoa\FileLinkRead;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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
           'id_cate'=>'6',
           'image'=>fake()->imageUrl(),
           'price'=>fake()->numberBetween(0,100000),
           'soLuong'=>fake()->numberBetween(0,30),
           'description'=>fake()->text(400)
        ];
    }
}
