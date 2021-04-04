<?php


namespace App\Domain\Entities\Utils;


class Stats
{
    public float $buy;
    public float $sell;
    public float $earn;
    public float $fee;
    public float $gain;
    public float $losses;
    public float $currentValue;

    /**
     * Stats constructor.
     * @param float $buy
     * @param float $sell
     * @param float $earn
     * @param float $fee
     * @param float $gain
     * @param float $losses
     * @param float $currentValue
     */
    public function __construct(
        float $buy,
        float $sell,
        float $earn,
        float $fee,
        float $gain,
        float $losses,
        float $currentValue
    ) {
        $this->buy = $buy;
        $this->sell = $sell;
        $this->earn = $earn;
        $this->fee = $fee;
        $this->gain = $gain;
        $this->losses = $losses;
        $this->currentValue = $currentValue;
    }


    /**
     * @return float
     */
    public function getBuy(): float
    {
        return $this->buy;
    }

    /**
     * @return float
     */
    public function getSell(): float
    {
        return $this->sell;
    }

    /**
     * @return float
     */
    public function getEarn(): float
    {
        return $this->earn;
    }

    /**
     * @return float
     */
    public function getFee(): float
    {
        return $this->fee;
    }

    /**
     * @return float
     */
    public function getGain(): float
    {
        return $this->gain;
    }

    /**
     * @return float
     */
    public function getLosses(): float
    {
        return $this->losses;
    }

    /**
     * @return float
     */
    public function getCurrentValue(): float
    {
        return $this->currentValue;
    }



}
