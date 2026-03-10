<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\HealthCheckLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $dbStatus = false;
        $cacheStatus = false;

        // DB Check
        try {
            DB::connection()->getPdo();
            $dbStatus = true;
        } catch (\Exception $e) {}

        // Redis Check
        try {
            $cacheStatus = (bool) Cache::store('redis')->set('health_check', true, 10);
        } catch (\Exception $e) {}

        HealthCheckLog::query()->create([
            'owner_uuid' => $request->header('X-Owner'),
            'db' => $dbStatus,
            'cache' => $cacheStatus,
        ]);

        $isOk = $dbStatus && $cacheStatus;

        return response()->json([
            'db' => $dbStatus,
            'cache' => $cacheStatus,
        ], $isOk ? 200 : 500);
    }
}
