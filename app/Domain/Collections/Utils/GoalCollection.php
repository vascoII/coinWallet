<?php


namespace App\Domain\Collections\Utils;


use App\Domain\Entities\Utils\Goal;

class GoalCollection
{
    private array $list;

    public function add(Goal $valueCoin): void
    {
        $this->list[] = $valueCoin;
    }

    public function all(): array
    {
        return $this->list;
    }
}
