<?php

namespace App\Domain\Collections\Transverse;

use App\Domain\Entities\Transverse\Transaction;

class TransactionCollection
{
    private array $list = [];

    public function add(Transaction $transaction): void
    {
        $this->list[] = $transaction;
    }

    public function all(): array
    {
        return $this->list;
    }

    public function getCount(): int
    {
        return count($this->list);
    }
}
