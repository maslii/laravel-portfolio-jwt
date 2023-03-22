<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'symbol' => $this->whenLoaded('symbol', $this->symbol->name),
            'shares' => $this->formatNumber($this->shares),
        ];
    }

    protected function formatNumber($value, $decimals = 5): string
    {
        return number_format($value, $decimals, '.', '');
    }
}
