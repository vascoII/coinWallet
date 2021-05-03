<?php


namespace App\Domain\Entities\CoinMarketCap;


class Quote
{
    public int $id;
    public string $symbol;
    public string $currency;
    public float $price;
    public string $volume24h;
    public string $percentChange1h;
    public string $percentChange24h;
    public string $percentChange7d;
    public string $percentChange30d;
    public string $percentChange60d;
    public string $percentChange90d;
    public string $marketCap;
    public string $lastUpdated;
    public ?string $maxSupply;
    public ?string $circulatingSupply;
    public ?string $totalSupply;

    /**
     * Quote constructor.
     * @param int $id
     * @param string $symbol
     * @param string $currency
     * @param float $price
     * @param string $volume24h
     * @param string $percentChange1h
     * @param string $percentChange24h
     * @param string $percentChange7d
     * @param string $percentChange30d
     * @param string $percentChange60d
     * @param string $percentChange90d
     * @param string $marketCap
     * @param string $lastUpdated
     * @param string|null $maxSupply
     * @param string|null $circulatingSupply
     * @param string|null $totalSupply
     */
    public function __construct(
        int $id,
        string $symbol,
        string $currency,
        float $price,
        string $volume24h,
        string $percentChange1h,
        string $percentChange24h,
        string $percentChange7d,
        string $percentChange30d,
        string $percentChange60d,
        string $percentChange90d,
        string $marketCap,
        string $lastUpdated,
        ?string $maxSupply,
        ?string $circulatingSupply,
        ?string $totalSupply
    ) {
        $this->id = $id;
        $this->symbol = $symbol;
        $this->currency = $currency;
        $this->price = $price;
        $this->volume24h = $volume24h;
        $this->percentChange1h = $percentChange1h;
        $this->percentChange24h = $percentChange24h;
        $this->percentChange7d = $percentChange7d;
        $this->percentChange30d = $percentChange30d;
        $this->percentChange60d = $percentChange60d;
        $this->percentChange90d = $percentChange90d;
        $this->marketCap = $marketCap;
        $this->lastUpdated = $lastUpdated;
        $this->maxSupply = $maxSupply;
        $this->circulatingSupply = $circulatingSupply;
        $this->totalSupply = $totalSupply;
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
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getVolume24h(): string
    {
        return $this->volume24h;
    }

    /**
     * @return string
     */
    public function getPercentChange1h(): string
    {
        return $this->percentChange1h;
    }

    /**
     * @return string
     */
    public function getPercentChange24h(): string
    {
        return $this->percentChange24h;
    }

    /**
     * @return string
     */
    public function getPercentChange7d(): string
    {
        return $this->percentChange7d;
    }

    /**
     * @return string
     */
    public function getPercentChange30d(): string
    {
        return $this->percentChange30d;
    }

    /**
     * @return string
     */
    public function getPercentChange60d(): string
    {
        return $this->percentChange60d;
    }

    /**
     * @return string
     */
    public function getPercentChange90d(): string
    {
        return $this->percentChange90d;
    }

    /**
     * @return string
     */
    public function getMarketCap(): string
    {
        return $this->marketCap;
    }

    /**
     * @return string
     */
    public function getLastUpdated(): string
    {
        return $this->lastUpdated;
    }

    /**
     * @return string|null
     */
    public function getMaxSupply(): ?string
    {
        return $this->maxSupply;
    }

    /**
     * @return string|null
     */
    public function getCirculatingSupply(): ?string
    {
        return $this->circulatingSupply;
    }

    /**
     * @return string|null
     */
    public function getTotalSupply(): ?string
    {
        return $this->totalSupply;
    }

}
