<?php


namespace App\Domain\Services\Coinbase;

use App\Domain\Repositories\Transverse\TransactionRepository;

class ValueChartService
{
    const HUNDRED_MILLION = 100000000;
    const HUNDRED_MILLION_SQUARE = 10000000000000000 ;

    public TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository) {
        $this->transactionRepository = $transactionRepository;
    }

    public function __invoke(array $quotes) : array
    {
        $res = [];
        foreach ($quotes as $key => $quote) {
            $res[$key]['date'] = date('Y-m-d H:m', strtotime($quote['date']));
            $res[$key]['value'] = 0;
            $coins = explode(',', $quote['data']);
            foreach($coins as $coin) {
                $res[$key]['value'] +=
                    intval(substr($coin, strpos($coin, ":") + 1)) *
                    $this->transactionRepository->findCoinAmountAtTime(strtok($coin, ':'), $quote['date']) /
                    self::HUNDRED_MILLION_SQUARE;
            }
            $res[$key]['value'] = round($res[$key]['value'], 2);
        }

        foreach ($res as $key => $value) {
            $res[$key]['spend'] = $this->transactionRepository->findSpendAtTime($res[$key]['date']) / self::HUNDRED_MILLION;
        }
        return $res;
    }
}
