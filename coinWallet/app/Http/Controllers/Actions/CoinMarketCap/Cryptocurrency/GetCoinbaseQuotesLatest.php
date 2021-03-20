<?php


namespace App\Http\Controllers\Actions\CoinMarketCap\Cryptocurrency;

use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Repositories\Coinbase\CoinRepository;
use App\Domain\Services\CoinMarketCap\QuoteLatestService;

class GetCoinbaseQuotesLatest
{
    public CoinRepository $coinRepository;
    public QuoteLatestService $quoteLatestService;
    public QuoteRepository $quoteRepository;

    public function __construct(
        CoinRepository $coinRepository,
        QuoteLatestService $quoteLatestService,
        QuoteRepository $quoteRepository
    ) {
        $this->coinRepository = $coinRepository;
        $this->quoteLatestService = $quoteLatestService;
        $this->quoteRepository = $quoteRepository;
    }

    public function __invoke(): void
    {
        $coinSymbolList = $this->coinRepository->findAllSymbol();

        $quoteCollection = $this->quoteLatestService->__invoke($coinSymbolList);
        foreach ($quoteCollection->all() as $quote) {
            $this->quoteRepository->save($quote);
        }
    }
}
