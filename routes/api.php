<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\HealthCheckController;
use App\Http\Middleware\HealthCheckMiddleware;

Route::get('/v1/health-check', HealthCheckController::class)
    ->middleware(['throttle:60,1', HealthCheckMiddleware::class]);
