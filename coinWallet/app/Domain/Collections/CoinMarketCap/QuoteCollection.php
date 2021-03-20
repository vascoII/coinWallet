<?php


namespace App\Domain\Collections\CoinMarketCap;


use App\Domain\Entities\CoinMarketCap\Quote;

class QuoteCollection
{
    private array $list;

    public function add(Quote $coin): void
    {
        $this->list[] = $coin;
    }

    public function all(): array
    {
        return $this->list;
    }
}
