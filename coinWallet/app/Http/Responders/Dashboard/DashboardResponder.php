<?php


namespace App\Http\Responders\Coinbase;

use App\Domain\Collections\Coinbase\CoinCollection;
use App\Domain\Collections\CoinMarketCap\QuoteCollection;
use App\Domain\Collections\Utils\AlertInfoCollection;
use App\Domain\Collections\Utils\PercentTransactionCollection;
use App\Domain\Collections\Utils\ValueCoinCollection;
use App\Domain\Entities\Utils\Stats;
use Illuminate\Http\Request;

class DashboardResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(
        Stats $coinbaseStat,
        CoinCollection $coinCollection,
        QuoteCollection $quotes,
        PercentTransactionCollection $percentsCoin,
        ValueCoinCollection $valueCoins,
        float $currentValue,
        ?AlertInfoCollection $alertInfoCollection
    ) {
        return view(
            'dashboard.index',
            [
                'stats' => $coinbaseStat,
                'coins' => $coinCollection->all(),
                'quotes' => $quotes->all(),
                'percentCoins' => $percentsCoin->all(),
                'valueCoins' => $valueCoins->all(),
                'currentValue' => $currentValue,
                'alertInfo' => $alertInfoCollection
            ]
        );
    }
}
