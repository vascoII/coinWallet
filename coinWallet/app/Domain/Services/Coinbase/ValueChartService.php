<?php


namespace App\Domain\Services\Coinbase;

use App\Domain\Repositories\Coinbase\TransactionRepository;

class ValueChartService
{
    const HUNDRED_MILLION_SQUARE = 10000000000000000 ;
    public TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository) {
        $this->transactionRepository = $transactionRepository;
    }

    public function __invoke(array $quotes) : array
    {
        $res = [];
        foreach ($quotes as $key => $quote) {
            $res[$key]['date'] = $quote['date'] * 1000;
            $res[$key]['value'] = 0;
            $coins = explode(',', $quote['data']);
            foreach($coins as $coin) {
                $res[$key]['value'] +=
                    intval(substr($coin, strpos($coin, ":") + 1)) *
                    $this->transactionRepository->findCoinAmountAtTime(strtok($coin, ':'), $quote['date']) /
                    self::HUNDRED_MILLION_SQUARE;
            }
        }
        return $res;
    }
}
