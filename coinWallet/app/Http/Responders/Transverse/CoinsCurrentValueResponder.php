<?php


namespace App\Http\Responders\Transverse;


use Illuminate\Http\Request;

class CurrentValueResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(array $valuesData, string $in)
    {
        return view('transverse.currentvalue', ['valuesData' => $valuesData, $in => true]);
    }
}
