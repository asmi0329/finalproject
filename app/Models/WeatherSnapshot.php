<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherSnapshot extends Model
{
    use HasFactory;

    protected $fillable = ['location', 'condition', 'temperature_c', 'humidity', 'wind_kph', 'fetched_at'];

    protected $casts = [
        'fetched_at' => 'datetime',
        'temperature_c' => 'decimal:2',
        'wind_kph' => 'decimal:2',
    ];
}
