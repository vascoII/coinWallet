<?php

namespace App\Infrastructure\Service\Binance;

use GuzzleHttp\Client as RestClient;

class BinanceService
{
    protected string $key;
    protected string $secret;
    protected string $passphrase;
    protected RestClient $restClient;
    protected string $basePath;

    public function __construct(RestClient $restClient) {
        $this->key = getenv('BINANCE_API_KEY');
        $this->secret = getenv('BINANCE_API_SECRET_KEY');
        $this->passphrase = '';
        $this->restClient = $restClient;
        $this->basePath = getenv('BINANCE_URL');
    }

    protected function signature($query_string) {
        return hash_hmac('SHA256', $query_string, $this->secret);
    }
}
