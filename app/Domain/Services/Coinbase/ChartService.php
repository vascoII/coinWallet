<?php


namespace App\Domain\Services\Coinbase;


use App\Domain\Repositories\Transverse\TransactionRepository;

class ChartService
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
        $i = 0;
        foreach ($quotes as $key => $quote) {
            $res[$i]['coins'] = $key;
            foreach ($quote as $num => $data) {
                $res[$i]['date'][$num] = date('Y-m-d H:m', strtotime($data['date']));
                $res[$i]['value'][$num] = round($data['price'] *
                        $this->transactionRepository->findCoinAmountAtTime($key, $data['price']) /
                        self::HUNDRED_MILLION_SQUARE, 2);
                $res[$i]['spend'][$num] = $this
                        ->transactionRepository
                        ->findSpendByCoinAtTime($key, date('Y-m-d H:m', strtotime($data['date'])))
                    / self::HUNDRED_MILLION;
            }
            $i++;
        }
        return $res;
    }
}
