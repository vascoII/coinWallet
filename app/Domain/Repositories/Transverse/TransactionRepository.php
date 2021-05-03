<?php


namespace App\Domain\Repositories\Transverse;

use App\Domain\Collections\Transverse\TransactionCollection;
use App\Domain\Entities\Transverse\Transaction;

interface TransactionRepository
{
    public function findAll(string $platform): TransactionCollection;
    public function findPartial(string $platform): TransactionCollection;
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
    public function findSpendAtTime(string $date): float;
    public function findSpendByCoinAtTime(string $symbol, string $date): float;
    public function findExchangeTotal(string $symbol, string $date): float;
    public function findAllSymbol(string $platform): array;
}
