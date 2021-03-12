<?php


namespace App\Infrastructure\Repositories\Coinbase;

use App\Domain\Collections\Coinbase\TransactionCollection;
use App\Domain\Repositories\Coinbase\TransactionRepository as TransactionRepositoryInterface;
use App\Infrastructure\Hydrator\Coinbase\TransactionHydrator;
use App\Infrastructure\Model\Coinbase\TransactionModel;


class TransactionRepository implements TransactionRepositoryinterface
{
    protected TransactionModel $model;
    protected TransactionHydrator $hydrator;

    public function __construct(TransactionModel $model, TransactionHydrator $hydrator)
    {
        $this->model = $model;
        $this->hydrator = $hydrator;
    }

    public function findAll(): TransactionCollection
    {
        $transactionCollection = new TransactionCollection();
        $collection = $this->model::orderBy('symbol')->orderBy('date_hour', 'ASC')->get();
        foreach ($collection as $item) {
            $transactionCollection->add($this->hydrator->hydrate($item));
        }
        return $transactionCollection;
    }
}
