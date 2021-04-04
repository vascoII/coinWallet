<?php


namespace App\Infrastructure\Service\Coinbase;

use App\Domain\Collections\CoinMarketCap\QuoteCollection;
use App\Domain\Collections\Utils\AlertInfoCollection;
use App\Domain\Entities\Utils\AlertInfo;
use App\Domain\Repositories\Coinbase\TransactionRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Services\Coinbase\GetAlertInfoService as GetAlertInfoServiceInterface;

class GetAlertInfoService implements GetAlertInfoServiceInterface
{
    public TransactionRepository $transactionRepository;
    public QuoteRepository $quoteRepository;

    public array $cgld = ['CELO' => 'CGLD'];

    const HUNDRED_MILLION = 100000000;

    public function __construct(TransactionRepository $transactionRepository, QuoteRepository $quoteRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->quoteRepository = $quoteRepository;
    }

    public function __invoke(QuoteCollection $quoteCollection): ?AlertInfoCollection
    {
        $alertInfoCollection = new AlertInfoCollection();
        $isAlert = false;
        foreach($quoteCollection->all() as $item)
        {
            $transaction = $this->transactionRepository->findOneBySymbol(
                array_key_exists($item->symbol, $this->cgld) ?
                    $this->cgld[$item->symbol] : $item->symbol
            );
            if (
                ($item->price / self::HUNDRED_MILLION) > floatval($transaction->getExchangeRate() * 3) &&
                $transaction->getExchangeRate() > 0
            ) {
                $alertInfoCollection->add(
                    new AlertInfo($item->symbol, $transaction->getAmount() / (3 * self::HUNDRED_MILLION))
                );
                $isAlert = true;
            } elseif (
                ($item->price / self::HUNDRED_MILLION) > floatval($transaction->getExchangeRate() * 3) &&
                $transaction->getExchangeRate() === 0
            ) {
                $quote = $this->quoteRepository->findFirstValues($item->symbol);
                if (($item->price / self::HUNDRED_MILLION) > floatval($quote->getPrice() * 3)) {
                    $alertInfoCollection->add(
                        new AlertInfo($item->symbol, $transaction->getAmount() / (3 * self::HUNDRED_MILLION))
                    );
                    $isAlert = true;
                }
            }
        }

        if ($isAlert) {
            return $alertInfoCollection;
        }

        return null;
    }
}
