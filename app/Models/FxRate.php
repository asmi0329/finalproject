<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FxRate extends Model
{
    use HasFactory;

    protected $fillable = ['base_currency', 'currency_name', 'unit', 'buy_rate', 'sell_rate', 'target_currency', 'rate', 'fetched_at', 'is_manual'];

    protected $casts = [
        'fetched_at' => 'datetime',
        'rate' => 'decimal:4',
        'buy_rate' => 'decimal:4',
        'sell_rate' => 'decimal:4',
        'unit' => 'integer',
        'is_manual' => 'boolean',
    ];
}
