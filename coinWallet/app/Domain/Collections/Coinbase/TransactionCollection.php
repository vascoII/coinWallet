<?php


namespace App\Domain\Collections\Coinbase;


use App\Domain\Entities\Coinbase\Transaction;

class TransactionCollection
{
    private array $list;

    public function add(Transaction $transaction): void
    {
        $this->list[] = $transaction;
    }

    public function all(): array
    {
        return $this->list;
    }
}
