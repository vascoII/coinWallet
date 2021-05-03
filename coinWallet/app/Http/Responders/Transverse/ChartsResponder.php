<?php

namespace App\Http\Responders\Transverse;

use Illuminate\Http\Request;

class ChartsResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(array $coinsWallet, float $totalSpend, float $totalGain, float $totalLosses, string $in)
    {
        return view('transverse.charts', [
            'values' => [
                'totalSpend' => $totalSpend,
                'totalGain' => $totalGain,
                'totalLosses' => $totalLosses
            ],
            'coinsWallet' => $coinsWallet,
            $in => true
        ]);
    }
}
