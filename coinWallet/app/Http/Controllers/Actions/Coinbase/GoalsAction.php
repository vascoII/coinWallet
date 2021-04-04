<?php


namespace App\Http\Controllers\Actions\Coinbase;

use App\Domain\Repositories\Coinbase\TransactionRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Services\Coinbase\ManageGoalsService;
use App\Http\Responders\Coinbase\GoalsResponder;

class GoalsAction
{
    public TransactionRepository $transactionRepository;
    public QuoteRepository $quoteRepository;
    public ManageGoalsService $manageGoalsService;
    public GoalsResponder $responder;

    public function __construct(
        TransactionRepository $transactionRepository,
        QuoteRepository $quoteRepository,
        ManageGoalsService $manageGoalsService,
        GoalsResponder $responder,
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->quoteRepository = $quoteRepository;
        $this->manageGoalsService = $manageGoalsService;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $transactionCollection = $this->transactionRepository->findAll();
        $distinctCoins = $this->transactionRepository->findDistinctCoinsSymbol();
        $lastQuoteCollection = $this->quoteRepository->findLast(count($distinctCoins));

        $goalCollection = $this->manageGoalsService->__invoke(
            $transactionCollection,
            $lastQuoteCollection,
            $distinctCoins
        );

        return $this->responder->send($goalCollection);
    }
}
