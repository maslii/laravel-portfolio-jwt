<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPortfolioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'symbol' => $this->whenLoaded('symbol', $this->symbol->name),
            'shares' => $this->formatNumber($this->shares),
            'first_value' => $this->formatNumber($this->first_value),
            'last_value' => $this->formatNumber($this->last_value),
            'change' => [
                'dollar' => $this->formatNumber($this->change['dollar']),
                'percentage' => $this->formatNumber($this->change['percentage']),
            ]
        ];
    }

    protected function formatNumber($value, $decimals = 5): string
    {
        return number_format($value, $decimals, '.', '');
    }
}
