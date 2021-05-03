<?php


namespace App\Http\Responders\Transverse;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SellsResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(string $platform)
    {
        if ($this->request->expectsJson()) {
            return new JsonResponse([
                'data' => '',
            ]);
        }

        return view('transverse.sells', ['platform' => $platform]);
    }
}
