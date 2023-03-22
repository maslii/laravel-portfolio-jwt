<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'portfolios' => ['sometimes', 'array'],
            'portfolios.*.symbol' => ['sometimes', 'exists:symbols,name'],
            'portfolios.*.shares' => ['sometimes', 'numeric', 'decimal:0,5'],
        ];
    }
}
