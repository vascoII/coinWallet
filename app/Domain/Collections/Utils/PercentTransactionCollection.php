<?php


namespace App\Domain\Collections\Utils;


use App\Domain\Entities\Utils\PercentTransaction;

class PercentTransactionCollection
{
    private array $list;

    public function add(PercentTransaction $percent): void
    {
        $this->list[] = $percent;
    }

    public function all(): array
    {
        return $this->list;
    }
}
