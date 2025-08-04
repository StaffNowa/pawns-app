<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController
{
    public function __construct(private ProfileService $profileService)
    {
    }

    public function getQuestions(): Collection
    {
        return $this->profileService->getQuestions();
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $result = $this->profileService->updateProfile($request);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 403);
        }

        return response()->json(['message' => $result['message']]);
    }
}
