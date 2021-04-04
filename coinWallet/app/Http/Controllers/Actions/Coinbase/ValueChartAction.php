<?php


namespace App\Http\Controllers\Actions\Coinbase;

use App\Domain\Repositories\Coinbase\TransactionRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Services\Coinbase\ValueChartService;
use App\Http\Responders\Coinbase\ValueChartResponder;

class ValueChartAction
{
    public TransactionRepository $transactionRepository;
    public QuoteRepository $quoteRepository;
    public ValueChartService $valueChartService;
    public ValueChartResponder $responder;

    public function __construct(
        TransactionRepository $transactionRepository,
        QuoteRepository $quoteRepository,
        ValueChartService $valueChartService,
        ValueChartResponder $responder,
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->quoteRepository = $quoteRepository;
        $this->valueChartService = $valueChartService;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $amountTransaction = $this->transactionRepository->findAllAmount();
        foreach ($amountTransaction as $key => $coin) {
            if ($coin === 0) {
                unset($amountTransaction[$key]);
            }
        }

        $quoteCollection = $this->quoteRepository->findAll();

        $chartsData = $this->valueChartService->__invoke($amountTransaction, $quoteCollection);
    }
}
