<?php

namespace Database\Factories;

use App\Models\SymbolsPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

class SymbolsPriceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date' => $this->getUniqueDate(),
            'price' => fake()->randomFloat(5, 0, 100),
        ];
    }

    // Just for science purposes

    protected function getUniqueDate(): string
    {
        do {
            $date = fake()->dateTimeThisYear()->format('Y-m-d');
        } while (SymbolsPrice::where('date', $date)->exists());

        return $date;
    }
}
