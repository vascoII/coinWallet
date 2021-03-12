<?php


namespace App\Domain\Repositories\Coinbase;

use App\Domain\Collections\Coinbase\TransactionCollection;

interface TransactionRepository
{
    public function findAll(): TransactionCollection;
}
