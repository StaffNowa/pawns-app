<?php

namespace App\Services;

use App\Models\PointsTransaction;
use App\Models\UserWallet;
use Illuminate\Support\Facades\DB;

class PointService
{
    public function claimPointsForUser($user): float
    {
        $transactions = PointsTransaction::where('user_id', $user->id)
            ->where('claimed', false)
            ->get();

        $totalPoints = $transactions->sum('points');
        $usdAmount = $totalPoints * 0.01;

        if ($usdAmount <= 0) {
            return 0;
        }

        UserWallet::updateOrCreate(
            ['user_id' => $user->id],
            ['balance' => DB::raw("balance + $usdAmount")]
        );

        foreach ($transactions as $transaction) {
            $transaction->update(['claimed' => true]);
        }

        return $usdAmount;

    }

}
