<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'symbol' => ['sometimes', 'string', 'exists:symbols,name'],
            'date' => ['sometimes', 'date'],
        ];
    }
}
