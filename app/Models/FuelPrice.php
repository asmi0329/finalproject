<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelPrice extends Model
{
    use HasFactory;

    protected $fillable = ['product', 'region', 'price', 'fetched_at', 'is_manual'];

    protected $casts = [
        'fetched_at' => 'datetime',
        'price' => 'decimal:2',
    ];
}
