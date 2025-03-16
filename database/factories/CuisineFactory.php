<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CuisineFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->sentence(2);
        return [
            'name' => $name,
            'slug' => strtolower(str_replace(" ", "-", $name)),
        ];
    }
}
