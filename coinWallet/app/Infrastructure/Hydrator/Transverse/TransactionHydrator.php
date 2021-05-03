<?php


namespace App\Infrastructure\Hydrator\Coinbase;

use App\Domain\Collections\Coinbase\TransactionCollection;
use App\Domain\Entities\Coinbase\Transaction;
use App\Infrastructure\Model\Coinbase\TransactionModel;

class TransactionHydrator
{
    const HUNDRED_MILLION = 100000000;

    private TransactionCollection $transactioncollection;

    public function __construct()
    {
        $this->transactioncollection = new TransactionCollection();
    }

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
            $transactionModel->platform,
            $transactionModel->sub_total,
            $transactionModel->fees,
            $transactionModel->total
        );
    }

    public function hydratePartial(TransactionModel $transactionModel): ?Transaction
    {
        if (is_null($transactionModel)) {
            return null;
        }
        return new Transaction(
            $transactionModel->id ?? 1,
            $transactionModel->symbol,
            $transactionModel->type ?? 'type',
            $transactionModel->reference_code ?? 'referenceCode',
            $transactionModel->payment_method ?? 'paymentMethod',
            $transactionModel->date_hour ?? 'dateHour',
            $transactionModel->amount,
            $transactionModel->exchange_rate ?? rand(),
            $transactionModel->platform,
            $transactionModel->sub_total ?? rand(),
            $transactionModel->fees ?? rand(),
            $transactionModel->total
        );
    }

    public function hydrateFromRequest(array $requestData): ?TransactionCollection
    {
        if (empty($requestData)) {
            return null;
        }

        switch ($requestData['type']) {
            case Transaction::BUY:
                return $this->buyCase($requestData);
                break;
            case Transaction::SELL:
                return $this->sellCase($requestData);
                break;
            case Transaction::EARN:
                return $this->earnCase($requestData);
                break;
            case Transaction::EXCHANGE:
                return $this->exchangeCase($requestData);
                break;
            default:
                return null;
                break;
        }
    }

    private function buyCase(array $requestData): TransactionCollection
    {
        $transaction = new Transaction(
            $requestData['id'],
            $requestData['symbol'],
            Transaction::BUY,
            $requestData['reference_code'],
            $requestData['payment_method'],
            $requestData['date_hour'],
            $requestData['amount'] * self::HUNDRED_MILLION,
            $requestData['exchange_rate'] * self::HUNDRED_MILLION,
            $requestData['platform'],
            $requestData['sub_total'] * self::HUNDRED_MILLION,
            $requestData['fees'] * self::HUNDRED_MILLION,
            $requestData['sub_total'] * self::HUNDRED_MILLION + $requestData['fees'] * self::HUNDRED_MILLION
        );
        $this->transactioncollection->add($transaction);
        return $this->transactioncollection;
    }

    private function sellCase(array $requestData): TransactionCollection
    {
        $transaction = new Transaction(
            $requestData['id'],
            $requestData['symbol'],
            Transaction::SELL,
            $requestData['reference_code'],
            $requestData['payment_method'],
            $requestData['date_hour'],
            $requestData['amount'] * self::HUNDRED_MILLION,
            $requestData['exchange_rate'] * self::HUNDRED_MILLION,
            $requestData['platform'],
            $requestData['sub_total'] * self::HUNDRED_MILLION,
            $requestData['fees'] * self::HUNDRED_MILLION,
            $requestData['total'] * self::HUNDRED_MILLION
        );
        $this->transactioncollection->add($transaction);
        return $this->transactioncollection;
    }

    private function earnCase(array $requestData): TransactionCollection
    {
        $transaction = new Transaction(
            $requestData['id'],
            $requestData['symbol'],
            Transaction::EARN,
            $requestData['reference_code'],
            Transaction::EARN,
            $requestData['date_hour'],
            $requestData['amount'] * self::HUNDRED_MILLION,
            $requestData['exchange_rate'] * self::HUNDRED_MILLION,
            $requestData['platform'],
            $requestData['total'] * self::HUNDRED_MILLION,
            0,
            $requestData['total'] * self::HUNDRED_MILLION
        );
        $this->transactioncollection->add($transaction);
        return $this->transactioncollection;
    }

    private function exchangeCase(array $requestData): TransactionCollection
    {
        $transactionPlus = new Transaction(
            $requestData['id'],
            $requestData['symbol'],
            Transaction::EXCHANGE,
            $requestData['reference_code'] . ' + ',
            $requestData['payment_method'],
            $requestData['date_hour'],
            $requestData['amount'] * self::HUNDRED_MILLION,
            0,
            $requestData['platform'],
            0,
            0,
            0
        );
        $transactionLess = new Transaction(
            $requestData['id'] + 1,
            $requestData['payment_method'],
            Transaction::EXCHANGE,
            $requestData['reference_code'] . ' - ',
            $requestData['symbol'],
            $requestData['date_hour'],
            - $requestData['exchange_rate'] * self::HUNDRED_MILLION,
            0,
            $requestData['platform'],
            0,
            0,
            0
        );

        $this->transactioncollection->add($transactionPlus);
        $this->transactioncollection->add($transactionLess);
        return $this->transactioncollection;
    }
}
