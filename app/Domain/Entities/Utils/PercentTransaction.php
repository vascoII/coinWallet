<?php


namespace App\Domain\Entities\Utils;


class PercentTransaction
{
    public string $name;
    public float $percent;

    public function __construct(string $name, float $percent)
    {
        $this->name = $name;
        $this->percent = $percent;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPercent(): float
    {
        return $this->percent;
    }

}
