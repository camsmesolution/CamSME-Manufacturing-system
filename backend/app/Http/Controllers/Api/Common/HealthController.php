<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;

class HealthController extends Controller
{
    // Test comment to trigger CI/CD deploy
    /**
     * @unauthenticated
     */
    public function index()
    {
        return response()->json([
            'status' => 'ok',
            'timestamp' => now()->toISOString(),
        ]);
    }
}
