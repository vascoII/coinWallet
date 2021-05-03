<?php


namespace App\Http\Responders\Coinbase;

use Illuminate\Http\Request;

class ChartsResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(array $chartsData, int $countCoins)
    {
        return view('coinbase.charts', ['chartsData' => $chartsData, 'countCoins' => $countCoins]);
    }
}
