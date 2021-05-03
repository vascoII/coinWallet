<?php

namespace App\Domain\Collections\Transverse;

use App\Domain\Entities\Transverse\Coin;

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
