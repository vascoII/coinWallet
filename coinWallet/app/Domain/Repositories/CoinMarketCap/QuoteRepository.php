<?php


namespace App\Domain\Repositories\CoinMarketCap;

use App\Domain\Collections\CoinMarketCap\QuoteCollection;
use App\Domain\Entities\CoinMarketCap\Quote;

interface QuoteRepository
{
    public function save(Quote $quote): void;
    public function findAll(): ?QuoteCollection;
}
