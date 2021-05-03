<?php


namespace App\Domain\Services\CoinMarketCap;


use App\Domain\Collections\CoinMarketCap\QuoteCollection;

interface QuoteLatestService
{
    public function __invoke(array $symbols, int $latestId): QuoteCollection;
}
