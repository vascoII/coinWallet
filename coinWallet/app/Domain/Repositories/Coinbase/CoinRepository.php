<?php

namespace App\Domain\Repositories\Coinbase;

use App\Domain\Collections\Coinbase\CoinCollection;
use App\Domain\Entities\Coinbase\Coin;

interface CoinRepository
{
    public function findAll(): ?CoinCollection;
    public function save(Coin $coin): void;
    public function findAllSymbol(): array;
    public function findOneById(int $id): Coin;
}
