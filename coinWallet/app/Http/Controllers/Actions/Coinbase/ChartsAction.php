<?php

namespace App\Http\Controllers\Actions\Coinbase;

use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Services\Coinbase\ChartsService;
use App\Domain\Services\Coinbase\ValueChartService;
use App\Http\Responders\Coinbase\ChartsResponder;
use App\Http\Responders\Coinbase\CurrentvalueResponder;

class ChartsAction
{
    public QuoteRepository $quoteRepository;
    public ValueChartService $valueChartService;
    public CurrentvalueResponder $responder;

    public function __construct(
        QuoteRepository $quoteRepository,
        ValueChartService $valueChartService,
        CurrentvalueResponder $responder
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->valueChartService = $valueChartService;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $quotes = $this->quoteRepository->findValueOverTime();
        $chartsData = $this->valueChartService->__invoke($quotes);
        return $this->responder->send($chartsData);
    }
}
