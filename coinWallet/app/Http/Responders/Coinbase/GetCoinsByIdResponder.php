<?php


namespace App\Http\Responders\Coinbase;

use App\Domain\Entities\Coinbase\Coin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetCoinsByIdResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(Coin $coin)
    {
        if ($this->request->expectsJson()) {
            return new JsonResponse([
                'data' => $coin,
            ]);
        }

        return view('coins.index', ['coin' => $coin]);
    }
}
