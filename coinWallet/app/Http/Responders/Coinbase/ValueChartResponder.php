<?php


namespace App\Http\Responders\Coinbase;

use Illuminate\Http\Request;

class ValueChartResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send()
    {
        return view('coinbase.charts', []);
    }
}
