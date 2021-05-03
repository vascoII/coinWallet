<?php


namespace App\Domain\Entities\Coinbase;

class Transaction
{
    public const BUY = 'buy';
    public const SELL = 'sell';
    public const EARN = 'earn';
    public const EXCHANGE = 'exchange';

    public const CGLD = 'CGLD';

    public int $id;
    public string $symbol;
    public string $type;
    public string $referenceCode;
    public string $paymentMethod;
    public string $dateHour;
    public int $amount;
    public int $exchangeRate;
    public string $platform;
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
        int $amount,
        int $exchangeRate,
        string $platform,
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
        $this->platform = $platform;
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
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getExchangeRate(): int
    {
        return $this->exchangeRate;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
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
