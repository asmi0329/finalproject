<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricityTariff extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'slab', 'rate', 'fetched_at', 'is_manual'];

    protected $casts = [
        'fetched_at' => 'datetime',
        'rate' => 'decimal:2',
    ];
}
