<?php


namespace App\Http\Responders\Coinbase;


use Illuminate\Http\Request;

class CurrentvalueResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(array $chartsData)
    {
        return view('coinbase.globalcurrentvalue', ['chartsData' => $chartsData]);
    }
}
