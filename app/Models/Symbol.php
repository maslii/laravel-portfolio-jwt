<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Symbol extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';

    public $timestamps = false;

    public function prices(): HasMany
    {
        return $this->hasMany(SymbolsPrice::class);
    }
}
