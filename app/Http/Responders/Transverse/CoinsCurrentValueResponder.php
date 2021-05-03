<?php

namespace App\Http\Responders\Transverse;

use Illuminate\Http\Request;

class CoinsCurrentValueResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(array $valuesData, string $platform, string $in, string $fiat)
    {
        return view('transverse.coinscurrentvalue', [
            'valuesData' => $valuesData,
            'platform' => $platform,
            $in => true,
            'fiat' => $fiat
        ]);
    }
}
