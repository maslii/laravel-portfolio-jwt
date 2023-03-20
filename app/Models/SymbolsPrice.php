<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SymbolsPrice extends Model
{
    public $timestamps = false;

    protected $keyType = 'string';

    use HasFactory, HasUlids;

    public function symbol(): BelongsTo
    {
        return $this->belongsTo(Symbol::class);
    }
}
