<?php

namespace App\Domain\Repositories\Transverse;

use App\Domain\Collections\Transverse\CoinCollection;
use App\Domain\Entities\Transverse\Coin;

interface CoinRepository
{
    public function findAll(): ?CoinCollection;
    public function save(Coin $coin): void;
    public function findAllSymbol(): array;
    public function findOneById(int $id): Coin;
    public function findOneBySymbol(string $symbol): Coin;
}
