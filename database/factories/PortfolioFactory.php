<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'shares' => fake()->randomFloat(5, 0, 100),
        ];
    }
}
