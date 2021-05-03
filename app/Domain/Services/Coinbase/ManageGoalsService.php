<?php


namespace App\Domain\Services\Coinbase;


use App\Domain\Collections\Transverse\TransactionCollection;
use App\Domain\Collections\CoinMarketCap\QuoteCollection;
use App\Domain\Collections\Utils\GoalCollection;
use App\Domain\Entities\Utils\Goal;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;

class ManageGoalsService
{
    const HUNDRED_MILLION = 100000000;

    public QuoteRepository $quoteRepository;

    public function __construct(QuoteRepository $quoteRepository) {
        $this->quoteRepository = $quoteRepository;
    }

    public function __invoke(
        TransactionCollection $transactionCollection,
        QuoteCollection $lastQuoteCollection,
        array $distinctCoins
    ): GoalCollection
    {
        $res = [];
        $goalCollection = new GoalCollection();

        foreach ($distinctCoins as $coin) {
            $res[$coin] = [
                'amount' => 0,
                'firstValue' => 0,
                'lastValue' => 0
            ];
        }

        foreach ($transactionCollection->all() as $item)
        {
            $res[$item->getSymbol()]['amount'] += $item->getAmount();
            $res[$item->getSymbol()]['firstValue'] +=
                $item->getAmount() * $item->getExchangeRate() / self::HUNDRED_MILLION + $item->getfees();
        }

        foreach ($res as $key => $row) {
            if ($row['amount'] === 0 ) {
                unset($res[$key]);
            } elseif ($row['firstValue'] === 0) {
                $res[$key]['firstValue'] = round(
                    $this->getFirstValue($key, $row['amount']) / self::HUNDRED_MILLION,
                    2);
                $res[$key]['lastValue'] = round(
                    $this->getLastValue($key, $row['amount'], $lastQuoteCollection) / self::HUNDRED_MILLION,
                    2);
            } else {
                $res[$key]['firstValue'] = round($row['firstValue'] / self::HUNDRED_MILLION, 2);
                $res[$key]['lastValue'] = round(
                    $this->getLastValue($key, $row['amount'], $lastQuoteCollection) / self::HUNDRED_MILLION,
                    2);
            }
        }

        $res = $this->evaluategoals($res);

        foreach ($res as $key => $values) {
            $goalCollection->add(
                new Goal(
                    $key,
                    $values['amount'] / self::HUNDRED_MILLION,
                    $values['firstValue'],
                    $values['lastValue'],
                    $values['amountSell'] / self::HUNDRED_MILLION,
                    $values['gain'],
                    $values['amountPostSell'] / self::HUNDRED_MILLION,
                    $values['valuePostSell'],
                    $values['percent']
                )
            );
        }
        return $goalCollection;
    }

    private function getFirstValue(string $key, int $amount): float
    {
        $key = $key === 'CGLD' ? 'CELO' : $key;
        return $amount * $this->quoteRepository->findFirstValues($key)->getPrice();
    }

    private function getLastValue(string $key, int $amount, QuoteCollection $lastQuoteCollection): float
    {
        $key = $key === 'CGLD' ? 'CELO' : $key;
        foreach ($lastQuoteCollection->all() as $item) {
            if ($item->getSymbol() === $key) {
                return $amount * $item->getPrice();
            }
        }
    }

    private function evaluategoals(array $res): array
    {
        foreach ($res as $key => $row) {
            if ($row['lastValue'] > $row['firstValue'] * 3) {
                //On vend 33% et on devient positif
                $res[$key]['amountSell'] = $row['amount'] / 3;
                $res[$key]['gain'] = $row['firstValue'];
                $res[$key]['amountPostSell'] = $row['amount'] / 3 * 2;
                $res[$key]['valuePostSell'] = $row['lastValue'] / 3 * 2;
                $res[$key]['percent'] = '30 %';
            } elseif ($row['lastValue'] > $row['firstValue'] * 2) {
                // On vend 50% et on devient positif
                $res[$key]['amountSell'] = $row['amount'] / 2;
                $res[$key]['gain'] = $row['firstValue'];
                $res[$key]['amountPostSell'] = $row['amount'] / 2;
                $res[$key]['valuePostSell'] = $row['lastValue'] / 2;
                $res[$key]['percent'] = '50 %';
            } elseif ($row['lastValue'] > $row['firstValue'] * 1.5) {
                // On vend 33% et on garde la mise initiale
                $res[$key]['amountSell'] = $row['amount'] / 3;
                $res[$key]['gain'] = $row['firstValue'] / 3;
                $res[$key]['amountPostSell'] = $row['amount'] / 3 * 2;
                $res[$key]['valuePostSell'] = $row['lastValue'] / 3 * 2;
                $res[$key]['percent'] = '30 %';
            } elseif ($row['lastValue'] > $row['firstValue'] * 1.4) {
                // On vend 28% et on garde la mise initiale
                $res[$key]['amountSell'] = $row['amount'] * 0.28;
                $res[$key]['gain'] = $row['firstValue'] * 0.28;
                $res[$key]['amountPostSell'] = $row['amount'] * 0.72;
                $res[$key]['valuePostSell'] = $row['lastValue'] * 0.72;
                $res[$key]['percent'] = '28 %';
            } elseif ($row['lastValue'] > $row['firstValue'] * 1.3) {
                // On vend 23% et on garde la mise initiale
                $res[$key]['amountSell'] = $row['amount'] * 0.23;
                $res[$key]['gain'] = $row['firstValue'] * 0.23;
                $res[$key]['amountPostSell'] = $row['amount'] * 0.77;
                $res[$key]['valuePostSell'] = $row['lastValue'] * 0.77;
                $res[$key]['percent'] = '23 %';
            } elseif ($row['lastValue'] > $row['firstValue'] * 1.2) {
                // On vend 16% et on garde la mise initiale
                $res[$key]['amountSell'] = $row['amount'] * 0.16;
                $res[$key]['gain'] = $row['firstValue'] * 0.16;
                $res[$key]['amountPostSell'] = $row['amount'] * 0.84;
                $res[$key]['valuePostSell'] = $row['lastValue'] * 0.84;
                $res[$key]['percent'] = '16 %';
            } elseif ($row['lastValue'] > $row['firstValue'] * 1.12) {
                // On vend 10% et on garde la mise initiale
                $res[$key]['amountSell'] = $row['amount'] * 0.10;
                $res[$key]['gain'] = $row['firstValue'] * 0.10;
                $res[$key]['amountPostSell'] = $row['amount'] * 0.9;
                $res[$key]['valuePostSell'] = $row['lastValue'] * 0.9;
                $res[$key]['percent'] = '10 %';
            } else {
                $res[$key]['amountSell'] = null;
                $res[$key]['gain'] = null;
                $res[$key]['amountPostSell'] = null;
                $res[$key]['valuePostSell'] = null;
                $res[$key]['percent'] = null;
            }
        }
        return $res;
    }

}
