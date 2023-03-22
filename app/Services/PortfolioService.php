<?php

namespace App\Services;

use App\Models\Portfolio;
use App\Models\Symbol;
use App\Models\SymbolsPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class PortfolioService
{
    public function show(Request $request): Collection
    {
        $portfolios = Portfolio::with('symbol')
            ->whereUserId(auth()->user()->id);

        if ($request->has('symbol')) {
            $symbolId = Symbol::where('name', $request->input('symbol'))->first()->id;
            $portfolios->where('symbol_id', $symbolId);
        }

        // SQL Joins can be used to improve performance

        $portfolios = $portfolios->get();

        foreach ($portfolios as $portfolio) {
            $portfolio['first_price'] = SymbolsPrice::where('symbol_id', $portfolio['symbol_id'])
                ->orderBy('date')->first()->price;

            $dateAvailable = $request->has('date') && SymbolsPrice::where('date', $request->input('date'))->exists();

            $portfolio['last_price'] = match ($dateAvailable) {
                true => SymbolsPrice::where('symbol_id', $portfolio['symbol_id'])
                    ->where('date', $request->input('date'))->first()->price,

                default => SymbolsPrice::where('symbol_id', $portfolio['symbol_id'])
                    ->orderByDesc('date')->first()->price,
            };

            $portfolio['last_value'] = $portfolio['last_price'] * $portfolio['shares'];
            $portfolio['first_value'] = $portfolio['first_price'] * $portfolio['shares'];

            $portfolio['change'] = [
                'dollar' => $portfolio['last_value'] - $portfolio['first_value'],
                'percentage' => ($portfolio['last_value'] - $portfolio['first_value']) / ($portfolio['first_value'] / 100),
            ];
        }

        return $portfolios;
    }

    public function store(Request $request): Collection
    {
        $requestData = $request->validated();
        $portfolios = new Collection();

        foreach ($requestData['portfolios'] as $portfolio) {
            $symbolId = Symbol::whereName($portfolio['symbol'])->first()->id;

            if (Portfolio::where('user_id', auth()->user()->id)->where('symbol_id', $symbolId)->exists()) {
                throw ValidationException::withMessages([
                    'symbol' => 'Symbol is already present in portfolio!'
                ]);
            }

            $portfolios->push(Portfolio::factory()->create([
                'shares' => $portfolio['shares'],
                'user_id' => auth()->user()->id,
                'symbol_id' => Symbol::whereName($portfolio['symbol'])->first()->id
            ]));
        }

        return $portfolios;
    }

    public function update(Request $request): Collection
    {
        $requestData = $request->validated();
        $portfolios = new Collection();

        foreach ($requestData['portfolios'] as $portfolio) {
            $symbolId = Symbol::whereName($portfolio['symbol'])->first()->id;

            $model = Portfolio::where('user_id', auth()->user()->id)
                ->where('symbol_id', $symbolId)->first();

            $model->update([
                'shares' => $portfolio['shares'],
            ]);

            $portfolios->push($model->refresh());
        }

        return $portfolios;
    }
}
