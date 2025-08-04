<?php

namespace App\Http\Controllers;

use App\Services\PointService;
use Illuminate\Http\JsonResponse;

class PointsController
{
    public function __construct(private readonly PointService $pointService)
    {
    }

    public function claimPoints(): JsonResponse
    {
        $user = auth()->user();

        $usdAmount = $this->pointService->claimPointsForUser($user);

        if ($usdAmount <= 0) {
            return response()->json(['message' => 'No points to claim'], 400);
        }

        return response()->json(['claimed' => $usdAmount]);
    }
}
