<?php


namespace App\Infrastructure\Hydrator\Coinbase;

use App\Domain\Entities\Coinbase\Transaction;
use App\Infrastructure\Model\Coinbase\TransactionModel;

class TransactionHydrator
{
    public function hydrate(TransactionModel $transactionModel): ?Transaction
    {
        if (is_null($transactionModel)) {
            return null;
        }
        return new Transaction(
            $transactionModel->id,
            $transactionModel->symbol,
            $transactionModel->type,
            $transactionModel->reference_code,
            $transactionModel->payment_method,
            $transactionModel->date_hour,
            $transactionModel->amount,
            $transactionModel->exchange_rate,
            $transactionModel->sub_total,
            $transactionModel->fees,
            $transactionModel->total
        );
    }
}
