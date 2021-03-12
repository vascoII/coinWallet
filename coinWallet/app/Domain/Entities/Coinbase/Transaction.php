<?php


namespace App\Domain\Entities\Coinbase;

class Transaction
{
    public int $id;
    public string $symbol;
    public string $type;
    public string $referenceCode;
    public string $paymentMethod;
    public string $dateHour;
    public float $amount;
    public float $exchangeRate;
    public int $subTotal;
    public int $fees;
    public int $total;

    public function __construct(
        int $id,
        string $symbol,
        string $type,
        string $referenceCode,
        string $paymentMethod,
        string $dateHour,
        float $amount,
        float $exchangeRate,
        int $subTotal,
        int $fees,
        int $total
    ) {
        $this->id = $id;
        $this->symbol = $symbol;
        $this->type = $type;
        $this->referenceCode = $referenceCode;
        $this->paymentMethod = $paymentMethod;
        $this->dateHour = $dateHour;
        $this->amount = $amount;
        $this->exchangeRate = $exchangeRate;
        $this->subTotal = $subTotal;
        $this->fees = $fees;
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getReferenceCode(): string
    {
        return $this->referenceCode;
    }

    /**
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * @return string
     */
    public function getDateHour(): string
    {
        return $this->dateHour;
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
    public function getExchangeRate(): float
    {
        return $this->exchangeRate;
    }

    /**
     * @return int
     */
    public function getSubTotal(): int
    {
        return $this->subTotal;
    }

    /**
     * @return int
     */
    public function getFees(): int
    {
        return $this->fees;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

}
