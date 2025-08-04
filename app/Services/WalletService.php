<?php

namespace App\Services;

use App\Models\PointsTransaction;

class WalletService
{
    public function getWalletData($user): array
    {
        $wallet = $user->wallet()->firstOrCreate([]);

        $unclaimed = PointsTransaction::where('user_id', $user->id)
            ->where('claimed', false)
            ->count();

        return [
            'balance' => $wallet->balance ?? number_format(0, 2, '.', ''),
            'unclaimed_points_transactions' => $unclaimed
        ];
    }
}
