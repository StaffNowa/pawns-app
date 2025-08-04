<?php

namespace App\Http\Controllers;

use App\Services\WalletService;
use Illuminate\Http\JsonResponse;

class WalletController extends Controller
{
    public function __construct(private WalletService $walletService)
    {
    }

    public function getWallet(): JsonResponse
    {
        $user = auth()->user();

        $data = $this->walletService->getWalletData($user);

        return response()->json($data);
    }
}
