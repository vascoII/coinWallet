<?php


namespace App\Domain\Services\Coinbase;


use App\Domain\Collections\CoinMarketCap\QuoteCollection;
use App\Domain\Collections\Utils\AlertInfoCollection;

interface GetAlertInfoService
{
    public function __invoke(QuoteCollection $quoteCollection): ?AlertInfoCollection;
}
