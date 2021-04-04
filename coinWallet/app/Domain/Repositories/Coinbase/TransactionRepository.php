<?php


namespace App\Domain\Repositories\Coinbase;

use App\Domain\Collections\Coinbase\TransactionCollection;
use App\Domain\Entities\Coinbase\Transaction;

interface TransactionRepository
{
    public function findAll(): TransactionCollection;
    public function findOneBySymbol(string $symbol): Transaction;
    public function findLastId(): int;
    public function save(Transaction $transaction): void;
    public function findAllGroupBySymbol(): TransactionCollection;
    public function findBuyFeesEar(): array;
    public function findAllAmount(): array;
    public function findAllAmountAndTotal(): array;
    public function findCurrentWalleteValues(): TransactionCollection;
    public function findDistinctCoinsSymbol(): array;
    public function findCoinAmountAtTime(string $symbol, string $strtotime): int;
}
