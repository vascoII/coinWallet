<?php


namespace App\Http\Responders\CoinMarketCap;

use App\Domain\Collections\CoinMarketCap\QuoteCollection;
use App\Domain\Entities\Coinbase\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetQuotesBySymbolResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(array $data, string $symbol)
    {
        if ($this->request->expectsJson()) {
            return new JsonResponse([
                'data' => $data,
            ]);
        }

        return view(
            'quotes.index',
            ['data' => $data, 'symbol' => $symbol]
        );
    }
}
