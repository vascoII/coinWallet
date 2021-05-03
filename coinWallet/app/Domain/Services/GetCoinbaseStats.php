<?php


namespace App\Domain\Services;

use App\Domain\Entities\Transverse\Transaction;
use App\Domain\Entities\Utils\Stats;
use App\Domain\Repositories\Transverse\TransactionRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;

class GetCoinbaseStats
{
    public TransactionRepository $transactionRepository;
    public QuoteRepository $quoteRepository;

    const HUNDRED_MILLION = 100000000;

    public const BUY = 'buy';
    public const SELL = 'sell';
    public const EARN = 'earn';
    public const FEES = 'fees';
    public const GAIN = 'gain';
    public const LOSSES = 'losses';

    public function __construct(TransactionRepository $transactionRepository, QuoteRepository $quoteRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->quoteRepository = $quoteRepository;
    }

    public function __invoke(): Stats
    {
        $resTransaction = $this->transactionRepository->findBuyFeesEar();
        $resAmount = $this->transactionRepository->findAllAmount();
        $resQuote = $this->quoteRepository->findLastValues($resAmount);

        [$gain, $losses, $currentValue] = $this->getGainAndLosses($resTransaction, $resAmount, $resQuote);

        return new Stats(
            round($resTransaction[self::BUY] / self::HUNDRED_MILLION, 2),
            0,
            round($resTransaction[self::EARN] / self::HUNDRED_MILLION, 2),
            round($resTransaction[self::FEES] / self::HUNDRED_MILLION, 2),
            round($gain / 100000000, 2),
            round($losses / 100000000, 2),
            round($currentValue / 100000000, 2)
        );
    }

    private function getGainAndLosses(array $resTransaction, array $resAmount, array $resQuote): array
    {
        $currentValue = 0;
        foreach ($resAmount as $symbol => $amount) {
            $currentValue += $amount * $resQuote[$symbol] / self::HUNDRED_MILLION;
        }

        if ($currentValue > $resTransaction[self::BUY]) {
            $gain = $currentValue - $resTransaction[self::BUY];
            $losses = 0;
        } else {
            $gain = 0;
            $losses = $resTransaction[self::BUY] - $currentValue;
        }

        return [$gain, $losses, $currentValue];
    }
}
