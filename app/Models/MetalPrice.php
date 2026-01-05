<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetalPrice extends Model
{
    use HasFactory;

    protected $fillable = ['metal_type', 'price', 'unit', 'currency', 'fetched_at', 'is_manual'];

    protected $casts = [
        'fetched_at' => 'datetime',
        'price' => 'decimal:2',
    ];
}
