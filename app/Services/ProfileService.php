<?php

namespace App\Services;

use App\Models\PointsTransaction;
use App\Models\ProfilingQuestion;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProfileService
{
    public function getQuestions(): Collection
    {
        return ProfilingQuestion::all();
    }

    public function updateProfile(Request $request): array
    {
        $user = auth()->user();
        $today = now()->toDateString();

        $profile = UserProfile::where('user_id', $user->id)->first();
        if ($profile && $profile->updated_at?->toDateString() === $today) {
            return ['error' => 'Profile can only be updated once a day'];
        }

        $validated = $request->validate([
            'answers' => 'required|array',
        ]);

        UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            ['answers' => $validated['answers'], 'updated_at' => now()]
        );

        PointsTransaction::create([
            'user_id' => $user->id,
            'points' => 5
        ]);

        return ['message' => 'Profile updated and 5 points awarded'];
    }
}
