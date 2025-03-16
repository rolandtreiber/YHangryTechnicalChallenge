<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class SetMenuFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => fake()->sentence(2),
            "description" => fake()->sentence(2),
            "display_text" => fake()->boolean(),
            "image" => fake()->url(),
            "thumbnail" => fake()->url(),
            "is_vegan" => fake()->boolean(),
            "is_vegetarian" => fake()->boolean(),
            "status" => fake()->randomNumber(1),
            "price_per_person" => fake()->numberBetween(10, 40),
            "min_spend" => fake()->numberBetween(100, 200),
            "is_seated" => fake()->boolean(),
            "is_standing" => fake()->boolean(),
            "is_canape" => fake()->boolean(),
            "is_mixed_dietary" => fake()->boolean(),
            "is_meal_prep" => fake()->boolean(),
            "is_halal" => fake()->boolean(),
            "is_kosher" => fake()->boolean(),
            "available" => fake()->boolean(),
            "number_of_orders" => fake()->numberBetween(1, 200)
        ];
    }
}
