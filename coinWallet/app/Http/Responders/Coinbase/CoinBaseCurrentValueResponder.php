<?php


namespace App\Http\Responders\Coinbase;

use Illuminate\Http\Request;

class CoinBaseCurrentValueResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(array $valuesData)
    {
        return view('coinbase.currentvalue', ['valuesData' => $valuesData]);
    }
}
