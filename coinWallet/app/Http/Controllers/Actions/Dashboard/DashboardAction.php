<?php


namespace App\Http\Controllers\Actions\Dashboard;


use App\Domain\Entities\Transverse\Transaction;
use App\Domain\Repositories\Transverse\CoinRepository;
use App\Domain\Repositories\Transverse\TransactionRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Services\Coinbase\GetAlertInfoService;
use App\Domain\Services\CoinMarketCap\CoinsPercentService;
use App\Domain\Services\CoinMarketCap\CoinsValueService;
use App\Domain\Services\GetCoinbaseStats;
use App\Domain\Services\MetaDataService;
use App\Http\Responders\Dashboard\DashboardResponder;

class DashboardAction
{
    public TransactionRepository $transactions;
    public CoinRepository $coinRepository;
    public QuoteRepository $quoteRepository;
    public DashboardResponder $responder;
    public GetCoinbaseStats $coinbaseStat;
    public MetaDataService $metaDataService;
    public CoinsPercentService $coinsPercentService;
    public CoinsValueService $coinsValueService;
    public GetAlertInfoService $getAlertInfoService;

    public function __construct(
        TransactionRepository $transactions,
        CoinRepository $coinRepository,
        QuoteRepository $quoteRepository,
        DashboardResponder $responder,
        GetCoinbaseStats $coinbaseStat,
        MetaDataService $metaDataService,
        CoinsPercentService $coinsPercentService,
        CoinsValueService $coinsValueService,
        GetAlertInfoService $getAlertInfoService
    ) {
        $this->transactions = $transactions;
        $this->coinRepository = $coinRepository;
        $this->quoteRepository = $quoteRepository;
        $this->responder = $responder;
        $this->coinbaseStat = $coinbaseStat;
        $this->metaDataService = $metaDataService;
        $this->coinsPercentService = $coinsPercentService;
        $this->coinsValueService = $coinsValueService;
        $this->getAlertInfoService = $getAlertInfoService;
    }

    public function __invoke()
    {
        $coinsData = [];

        $coinSymbolList = $this->coinRepository->findAllSymbol();
        $quoteCollection = $this->quoteRepository->findLast(count($coinSymbolList));

        $coins = $this->coinRepository->findAll();
        if (!is_null($coins)) {
            foreach($coins->all() as $coin) {
                $coinsData[$coin->getSymbol()] = $coin->getName();
            }
        }

        $coinBaseStat = $this->transactions->findAllGroupBySymbol();
        foreach ($coinBaseStat->all() as $coin) {
            if (!in_array($coin->getSymbol(), $coinSymbolList) && $coin->getSymbol() != Transaction::CGLD) {
                try {
                    $data = $this->metaDataService->__invoke($coin->getSymbol());
                } catch (\Exception $ex) {
                    continue;
                }
                $this->coinRepository->save($data);
            }
        }

        $alert_info = $this->getAlertInfoService->__invoke($quoteCollection);

        $percentsCoin = $this->coinsPercentService->__invoke($coinsData);
        $valueCoins = $this->coinsValueService->__invoke($coinsData);
        $stats = $this->coinbaseStat->__invoke();
        return $this->responder->send(
            $stats,
            $coins,
            $quoteCollection,
            $percentsCoin,
            $valueCoins,
            $stats->getCurrentValue(),
            $alert_info

        );
    }
}
