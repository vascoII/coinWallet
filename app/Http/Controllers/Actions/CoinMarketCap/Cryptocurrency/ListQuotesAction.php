<?php


namespace App\Http\Controllers\Actions\CoinMarketCap\Cryptocurrency;

use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Http\Responders\CoinMarketCap\ListQuotesResponder;

use Illuminate\Http\Request;

class ListQuotesAction
{
    public QuoteRepository $quoteRepository;
    public ListQuotesResponder $responder;

    public function __construct(QuoteRepository $quoteRepository, ListQuotesResponder $responder)
    {
        $this->quoteRepository = $quoteRepository;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        $quotes = $this->quoteRepository->findAll();
        return $this->responder->send($quotes);
    }
}
