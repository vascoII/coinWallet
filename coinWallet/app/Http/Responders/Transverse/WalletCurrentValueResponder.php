<?php

namespace App\Http\Responders\Transverse;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletCurrentValueResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(array $coinsWallet, array $coinsSymbols, array $coinsTotal, string $platform, string $in)
    {
        if ($this->request->expectsJson()) {
            return new JsonResponse([
                'data' => $coinsWallet,
            ]);
        }

        return view('transverse.walletcurrentvalue', [
            'coinsWallet' => $coinsWallet,
            'coinsSymbols' => $coinsSymbols,
            'coinsTotal' => $coinsTotal,
            'platform' => $platform,
            $in => true
        ]);
    }
}
