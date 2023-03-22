<?php

namespace App\Services;

use App\Models\Portfolio;
use App\Models\Symbol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(Request $request): string
    {
        $requestData = $request->validated();
        $portfolioData = $requestData['portfolios'] ?? null;

        if (Arr::exists($requestData, 'password')) {
            $requestData['password'] = Hash::make($requestData['password']);
        }

        if (Arr::exists($requestData, 'portfolios')) {
            Arr::forget($requestData, 'portfolios');
        }

        $user = User::factory()->create($requestData);

        if ($portfolioData) {
            foreach ($portfolioData as $portfolio) {
                Portfolio::factory()->create([
                    'shares' => $portfolio['shares'],
                    'user_id' => $user->id,
                    'symbol_id' => Symbol::whereName($portfolio['symbol'])->first()->id
                ]);
            }
        }

        return auth()->login($user);
    }
}
