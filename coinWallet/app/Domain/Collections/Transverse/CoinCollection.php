<?php

namespace App\Domain\Collections\Coinbase;

use App\Domain\Entities\Coinbase\Coin;

class CoinCollection
{
    private array $list;

    public function add(Coin $coin): void
    {
        $this->list[] = $coin;
    }

    public function all(): array
    {
        return $this->list;
    }
}
