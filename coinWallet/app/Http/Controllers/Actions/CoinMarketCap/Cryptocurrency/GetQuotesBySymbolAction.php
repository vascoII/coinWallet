<?php


namespace App\Http\Controllers\Actions\CoinMarketCap\Cryptocurrency;

use App\Domain\Repositories\Coinbase\TransactionRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Http\Responders\CoinMarketCap\GetQuotesBySymbolResponder;

class GetQuotesBySymbolAction
{
    public TransactionRepository $transactions;
    public QuoteRepository $quoteRepository;
    public GetQuotesBySymbolResponder $responder;

    public function __construct(
        TransactionRepository $transactions,
        QuoteRepository $quoteRepository,
        GetQuotesBySymbolResponder $responder
    ) {
        $this->transactions = $transactions;
        $this->quoteRepository = $quoteRepository;
        $this->responder = $responder;
    }

    public function __invoke(string $symbol)
    {
        $transaction = $this->transactions->findOneBySymbol($symbol);
        $data[] = [
            'date' => date('Y-m-d', strtotime($transaction->getDateHour())),
            'price' => $transaction->getExchangeRate()
        ];

        $quotes = $this->quoteRepository->findHistoryBySymbol($symbol);
        foreach ($quotes->all() as $quote) {
            $data[] = [
                'date' => date('Y-m-d', strtotime($quote->getLastUpdated())),
                'price' => $quote->getPrice()
            ];
        }

        return $this->responder->send($data, $symbol);
    }
}
