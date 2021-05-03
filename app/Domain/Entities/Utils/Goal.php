<?php


namespace App\Domain\Entities\Utils;


class Goal
{
    public string $symbol;
    public float $amount;
    public float $firstVale;
    public float $lastValue;
    public ?float $amountSell;
    public ?float $gain;
    public ?float $amountPostSell;
    public ?float $valuePostSell;
    public ?string $percent;

    public function __construct(
        string $symbol,
        float $amount,
        float $firstVale,
        float $lastValue,
        ?float $amountSell,
        ?float $gain,
        ?float $amountPostSell,
        ?float $valuePostSell,
        ?string $percent
    ) {
        $this->symbol = $symbol;
        $this->amount = $amount;
        $this->firstVale = $firstVale;
        $this->lastValue = $lastValue;
        $this->amountSell = $amountSell;
        $this->gain = $gain;
        $this->amountPostSell = $amountPostSell;
        $this->valuePostSell = $valuePostSell;
        $this->percent = $percent;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getFirstVale(): float
    {
        return $this->firstVale;
    }

    /**
     * @return float
     */
    public function getLastValue(): float
    {
        return $this->lastValue;
    }

    /**
     * @return float|null
     */
    public function getAmountSell(): ?float
    {
        return $this->amountSell;
    }

    /**
     * @return float|null
     */
    public function getGain(): ?float
    {
        return $this->gain;
    }

    /**
     * @return float|null
     */
    public function getAmountPostSell(): ?float
    {
        return $this->amountPostSell;
    }

    /**
     * @return float|null
     */
    public function getValuePostSell(): ?float
    {
        return $this->valuePostSell;
    }

    /**
     * @return string|null
     */
    public function getPercent(): ?string
    {
        return $this->percent;
    }



}
