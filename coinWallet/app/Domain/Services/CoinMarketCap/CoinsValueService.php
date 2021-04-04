<?php


namespace App\Domain\Services\CoinMarketCap;

use App\Domain\Collections\Utils\ValueCoinCollection;
use App\Domain\Entities\Utils\ValueCoin;
use App\Domain\Repositories\Coinbase\TransactionRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;

class CoinsValueService
{
    const HUNDRED_MILLION = 100000000;
    public array $cgld = ['CGLD' => 'CELO'];

    public TransactionRepository $transactionRepository;
    public QuoteRepository $quoteRepository;

    public function __construct(TransactionRepository $transactionRepository, QuoteRepository $quoteRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->quoteRepository = $quoteRepository;
    }

    public function __invoke(array $coinsData): ValueCoinCollection
    {
        $amountTransaction = $this->transactionRepository->findAllAmount();
        $resQuote = $this->quoteRepository->findLastValues($amountTransaction);

        $valueCoinCollection = new ValueCoinCollection();

        foreach ($amountTransaction as $symbol => $amount) {
            if ($amount > 0) {
                $valueCoinCollection->add(
                    new ValueCoin(
                        array_key_exists($symbol, $this->cgld) ?
                            $this->cgld[$symbol] : $symbol,
                        round($amount * $resQuote[$symbol] / (self::HUNDRED_MILLION * self::HUNDRED_MILLION), 2)
                    )
                );
            }
        }

        return $valueCoinCollection;
    }
}
