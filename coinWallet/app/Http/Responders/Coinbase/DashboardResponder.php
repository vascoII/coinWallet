<?php


namespace App\Http\Responders\Coinbase;

use App\Domain\Collections\Coinbase\CoinCollection;
use App\Domain\Entities\Utils\Stats;
use Illuminate\Http\Request;

class DashboardResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(Stats $coinbaseStat, CoinCollection $coinCollection)
    {
        return view('dashboard.index', ['stats' => $coinbaseStat, 'coins' => $coinCollection->all()]);
    }
}
