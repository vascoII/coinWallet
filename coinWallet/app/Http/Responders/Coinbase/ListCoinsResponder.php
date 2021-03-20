<?php


namespace App\Http\Responders\Coinbase;

use App\Domain\Collections\Coinbase\CoinCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListCoinsResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(CoinCollection $coins)
    {
        if ($this->request->expectsJson()) {
            return new JsonResponse([
                'data' => $coins,
            ]);
        }

        return view('coins.list', ['coins' => $coins->all()]);
    }
}
