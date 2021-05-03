<?php


namespace App\Infrastructure\Service\CoinMarketCap;

use App\Infrastructure\Hydrator\Transverse\CoinHydrator;
use App\Infrastructure\Hydrator\CoinMarketCap\QuoteHydrator;
use GuzzleHttp\Client as RestClient;

class CoinMarketCapService
{
    protected RestClient $restClient;
    protected CoinHydrator $coinHydrator;
    protected QuoteHydrator $quoteHydrator;
    protected string $basePath;
    protected string $apiKey;

    public function __construct(RestClient $restClient, CoinHydrator $coinHydrator, QuoteHydrator $quoteHydrator) {
        $this->restClient = $restClient;
        $this->coinHydrator = $coinHydrator;
        $this->quoteHydrator = $quoteHydrator;
        $this->basePath = getenv('COIN_MARKET_CAP_URL');
        $this->apiKey = getenv('COIN_MARKET_CAP_API_KEY');
    }
}
