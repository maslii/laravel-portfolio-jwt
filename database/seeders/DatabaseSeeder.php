<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Portfolio;
use App\Models\Symbol;
use App\Models\SymbolsPrice;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $symbols = Symbol::factory(10)->create();
        $users = User::factory(2)->create();

        $users->push(User::factory([
            'name' => fake()->name(),
            'email' => 'admin@localhost.local',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ])->create());

        foreach ($symbols as $symbol) {
            SymbolsPrice::factory(100)->for($symbol)->create();

            foreach ($users as $user) {
                Portfolio::factory(3)->for($symbol)->for($user)->create();
            }
        }
    }
}
