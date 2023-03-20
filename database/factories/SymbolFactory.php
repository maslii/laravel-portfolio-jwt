<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SymbolFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => strtoupper(fake()->lexify())
        ];
    }
}
