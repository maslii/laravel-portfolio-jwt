<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string'],
            'portfolios' => ['sometimes', 'array'],
            'portfolios.*.symbol' => ['sometimes', 'exists:symbols,name'],
            'portfolios.*.shares' => ['sometimes', 'decimal:0,5'],
        ];
    }
}
