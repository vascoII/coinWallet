<?php


namespace App\Domain\Services;


use App\Domain\Collections\Coinbase\TransactionCollection;
use App\Domain\Entities\Utils\Stats;

class GetCoinbaseStats
{

    public function __invoke(TransactionCollection $transactions): Stats
    {
        $sumBuy = 0;
        $sumFees = 0;
        foreach ($transactions->all() as $transaction) {
            $sumBuy += $transaction->getSubTotal();
            $sumFees += $transaction->getFees();
        }

        return new Stats(
            $sumBuy / 100,
            0.00,
            0.00,
            $sumFees / 100,
            0.00,
            - $sumFees / 100,
             - $sumFees / 100
        );
    }
}
