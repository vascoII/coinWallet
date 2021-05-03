<?php


namespace App\Domain\Collections\Utils;


use App\Domain\Entities\Utils\ValueCoin;

class ValueCoinCollection
{
    private array $list;

    public function add(ValueCoin $valueCoin): void
    {
        $this->list[] = $valueCoin;
    }

    public function all(): array
    {
        return $this->list;
    }
}
