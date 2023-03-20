<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SymbolsPriceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date' => fake()->dateTimeThisMonth(),
            'price' => fake()->randomFloat(5, 0, 100),
        ];
    }
}
