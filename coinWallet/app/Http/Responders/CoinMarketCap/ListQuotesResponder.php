<?php


namespace App\Http\Responders\CoinMarketCap;


use App\Domain\Collections\CoinMarketCap\QuoteCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListQuotesResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(QuoteCollection $quotes)
    {
        if ($this->request->expectsJson()) {
            return new JsonResponse([
                'data' => $quotes,
            ]);
        }

        return view('quotes.list', ['quotes' => $quotes->all()]);
    }
}
