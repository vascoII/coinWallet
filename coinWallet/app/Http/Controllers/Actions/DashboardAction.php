<?php


namespace App\Http\Controllers\Actions;


use App\Domain\Repositories\Coinbase\CoinRepository;
use App\Domain\Repositories\Coinbase\TransactionRepository;
use App\Domain\Services\GetCoinbaseStats;
use App\Domain\Services\MetaDataService;
use App\Http\Responders\Coinbase\DashboardResponder;

class DashboardAction
{
    public TransactionRepository $transactions;
    public CoinRepository $coinRepository;
    public DashboardResponder $responder;
    public GetCoinbaseStats $coinbaseStat;
    public MetaDataService $metaDataService;

    public function __construct(
        TransactionRepository $transactions,
        CoinRepository $coinRepository,
        DashboardResponder $responder,
        GetCoinbaseStats $coinbaseStat,
        MetaDataService $metaDataService
    ) {
        $this->transactions = $transactions;
        $this->coinRepository = $coinRepository;
        $this->responder = $responder;
        $this->coinbaseStat = $coinbaseStat;
        $this->metaDataService = $metaDataService;
    }

    public function __invoke()
    {
        $coinSymbolList = $this->coinRepository->findAllSymbol();
        $coins = $this->coinRepository->findAll();
        $coinBaseStat = $this->transactions->findAll();

        foreach ($coinBaseStat->all() as $coin) {
            if (!in_array($coin->getSymbol(), $coinSymbolList)) {
                $data = $this->metaDataService->__invoke($coin->getSymbol());
                $this->coinRepository->save($data);
            }
        }

        return $this->responder->send($this->coinbaseStat->__invoke($coinBaseStat, ), $coins);
    }
}
