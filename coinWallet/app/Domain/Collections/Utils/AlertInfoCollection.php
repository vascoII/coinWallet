<?php


namespace App\Domain\Collections\Utils;


use App\Domain\Entities\Utils\AlertInfo;

class AlertInfoCollection
{
    private array $list;

    public function add(AlertInfo $alertInfo): void
    {
        $this->list[] = $alertInfo;
    }

    public function all(): array
    {
        return $this->list;
    }
}
