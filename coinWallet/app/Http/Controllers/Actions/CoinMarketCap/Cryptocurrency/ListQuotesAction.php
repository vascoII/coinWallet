<?php


namespace App\Http\Controllers\Actions\CoinMarketCap\Cryptocurrency;

use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Http\Responders\CoinMarketCap\ListQuotesResponder;

class ListQuotesAction
{
    public QuoteRepository $quoteRepository;
    public ListQuotesResponder $responder;

    public function __construct(QuoteRepository $quoteRepository, ListQuotesResponder $responder)
    {
        $this->quoteRepository = $quoteRepository;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $quotes = $this->quoteRepository->findAll();
        return $this->responder->send($quotes);
    }
}
