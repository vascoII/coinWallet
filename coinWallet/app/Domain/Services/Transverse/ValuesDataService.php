<?php

namespace App\Domain\Services\Transverse;

use App\Domain\Collections\Transverse\TransactionCollection;
use App\Domain\Collections\CoinMarketCap\QuoteCollection;

class ValuesDataService
{
    const HUNDRED_MILLION = 100000000;
    const HUNDRED_MILLION_SQUARE = 10000000000000000 ;

    public function __invoke(
        TransactionCollection $transactionCollection,
        QuoteCollection $firstQuoteCollection,
        QuoteCollection $lastQuoteCollection
    ): array
    {
        $coins = [];
        $coinList = [];

        foreach ($transactionCollection->all() as $transaction) {
            $coins[$transaction->getSymbol()] = ['amount' => 0, 'buy_rate' => 0, 'current_rate' => 0];
        }
        foreach ($transactionCollection->all() as $transaction) {
            $coins[$transaction->getSymbol()]['amount'] += $transaction->getAmount();
            if ($coins[$transaction->getSymbol()]['buy_rate'] === 0) {
                $coins[$transaction->getSymbol()]['buy_rate'] = $transaction->getExchangeRate();
            }
        }
        foreach ($coins as $key => $coin) {
            if($coin['amount'] === 0) {
                unset($coins[$key]);
            } else {
                $coins[$key]['buy_rate'] = $coins[$key]['buy_rate'] / self::HUNDRED_MILLION;
                $coins[$key]['amount'] = $coins[$key]['amount'] / self::HUNDRED_MILLION;
                $coinList[] = $key;
            }
        }
        foreach ($lastQuoteCollection->all() as $quote) {
            if (in_array($quote->getSymbol() === "CELO" ? "CGLD" : $quote->getSymbol(), $coinList)) {
                $coins[$quote->getSymbol() === "CELO" ? "CGLD" : $quote->getSymbol()]['current_rate'] =
                    $quote->getPrice();
            }
        }

        foreach ($firstQuoteCollection->all() as $quote) {
            if (isset($coins[$quote->getSymbol() === "CELO" ? "CGLD" : $quote->getSymbol()]) &&
                $coins[$quote->getSymbol() === "CELO" ? "CGLD" : $quote->getSymbol()]['buy_rate'] === 0
            ) {
                $coins[$quote->getSymbol() === "CELO" ? "CGLD" : $quote->getSymbol()]['buy_rate'] =
                    $quote->getPrice();
            }
        }

        return $coins;
    }
}
