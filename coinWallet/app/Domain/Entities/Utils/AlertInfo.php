<?php


namespace App\Domain\Entities\Utils;


class AlertInfo
{
    public string $coinSymbol;
    public int $amount;

    /**
     * AlertInfo constructor.
     * @param string $coinSymbol
     * @param int $amount
     */
    public function __construct(string $coinSymbol, int $amount)
    {
        $this->coinSymbol = $coinSymbol;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCoinSymbol(): string
    {
        return $this->coinSymbol;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }


}
