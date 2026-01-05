<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/**
 * Schedule the rates fetch command to run hourly.
 */
use Illuminate\Support\Facades\Schedule;
Schedule::command('rates:fetch')->hourly();
