<?php

namespace App\Http\Controllers\Actions\Transverse;

use App\Domain\Repositories\Transverse\TransactionRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Services\Transverse\ValuesDataService;
use App\Http\Responders\Transverse\CurrentValueResponder;
use Illuminate\Http\Request;

class CurrentValueAction extends TransverseAction
{
    public TransactionRepository $transactions;
    public QuoteRepository $quoteRepository;
    public ValuesDataService $valuesDataService;
    public CurrentValueResponder $responder;

    public function __construct(
        TransactionRepository $transactions,
        QuoteRepository $quoteRepository,
        ValuesDataService $valuesDataService,
        CurrentValueResponder $responder
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->transactions = $transactions;
        $this->valuesDataService = $valuesDataService;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        [$platform, $in] = $this->init($request);
        $countCoins = [];
        $transactionCollection = $this->transactions->findPartial($platform);
        foreach ($transactionCollection->all() as $coin) {
            $countCoins[] = $coin->getSymbol();
        }
        $lastQuoteCollection = $this->quoteRepository->findLastBySymbols(array_unique($countCoins));
        $firstQuoteCollection = $this->quoteRepository->findFirstBySymbols(array_unique($countCoins));

        $valuesData = $this->valuesDataService->__invoke(
            $transactionCollection,
            $firstQuoteCollection,
            $lastQuoteCollection
        );
        return $this->responder->send($valuesData, $in);
    }
}
