<?php


namespace App\Domain\Services\CoinMarketCap;

use App\Domain\Collections\Utils\PercentTransactionCollection;
use App\Domain\Entities\Utils\PercentTransaction;
use App\Domain\Repositories\Transverse\TransactionRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;

class CoinsPercentService
{
    public array $celo = ['CGLD' => 'CELO'];

    public TransactionRepository $transactions;
    public QuoteRepository $quoteRepository;

    /**
     * CoinsPercentService constructor.
     * @param TransactionRepository $transactions
     */
    public function __construct(
        TransactionRepository $transactions,
        QuoteRepository $quoteRepository
    ) {
        $this->transactions = $transactions;
        $this->quoteRepository = $quoteRepository;
    }

    public function __invoke(array $coinsData): PercentTransactionCollection
    {
        $res = [];
        $total = 0;
        $percentCollection = new PercentTransactionCollection();

        $transactions = $this->transactions->findAllAmountAndTotal();

        foreach ($transactions as $row) {
            $total += $row['total'];
        }

        foreach ($transactions as $symbol => $row) {
            if ($row['amount'] === 0) {
                continue;
            } elseif (
                !empty($coinsData[array_key_exists($symbol, $this->celo) ? $this->celo[$symbol] : $symbol]) &&
                $row['total'] !== 0
            ) {
                $percentCollection->add(
                    new PercentTransaction(
                        $coinsData[array_key_exists($symbol, $this->celo) ?
                            $this->celo[$symbol] : $symbol] . ' (' . $symbol . ')',
                        round($row['total'] * 100 / $total, 1)
                    )
                );
            } else {
                $earlyPrice = $this->quoteRepository->findFirstValues($symbol);
                $percentCollection->add(
                    new PercentTransaction(
                        $coinsData[$symbol] . ' (' . $symbol . ')',
                        round($row['amount'] * $earlyPrice->getPrice() * 100 / $total, 1)
                    )
                );
            }
        }

        return $percentCollection;
    }
}
