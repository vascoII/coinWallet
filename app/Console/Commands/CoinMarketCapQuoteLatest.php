<?php

namespace App\Console\Commands;

use App\Domain\Repositories\Transverse\CoinRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Services\CoinMarketCap\QuoteLatestService;
use Illuminate\Console\Command;

class CoinMarketCapQuoteLatest extends Command
{
    public CoinRepository $coinRepository;
    public QuoteLatestService $quoteLatestService;
    public QuoteRepository $quoteRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:latest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'register latest quotes data from CoinMarketCap';

    /**
     * Create a new command instance.
     *
     * @param CoinRepository $coinRepository
     * @param QuoteLatestService $quoteLatestService
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        CoinRepository $coinRepository,
        QuoteLatestService $quoteLatestService,
        QuoteRepository $quoteRepository
    ) {
        parent::__construct();
        $this->coinRepository = $coinRepository;
        $this->quoteLatestService = $quoteLatestService;
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $latestId = $this->quoteRepository->findLastId();
        $coinSymbolList = $this->coinRepository->findAllSymbol();

        $quoteCollection = $this->quoteLatestService->__invoke($coinSymbolList, $latestId);
        foreach ($quoteCollection->all() as $quote) {
            $this->quoteRepository->save($quote);
        }
        return 0;
    }
}
