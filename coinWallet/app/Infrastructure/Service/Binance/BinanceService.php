<?php

namespace App\Infrastructure\Service\Coinbase;

use GuzzleHttp\Client as RestClient;

class CoinbaseService
{
    protected string $key;
    protected string $secret;
    protected string $passphrase;
    protected RestClient $restClient;
    protected string $basePath;

    public function __construct(RestClient $restClient) {
        $this->key = getenv('COINBASE_API_KEY');;
        $this->secret = getenv('COINBASE_API_SECRET_KEY');
        $this->passphrase = '';
        $this->restClient = $restClient;
        $this->basePath = getenv('COINBASE_URL');
    }

    protected function signature($request_path = '', $body = '', $timestamp = false, $method='GET') {
        $body = is_array($body) ? json_encode($body) : $body;
        $timestamp = $timestamp ? $timestamp : time();

        $what = $timestamp.$method.$request_path.$body;

        return base64_encode(hash_hmac("sha256", $what, base64_decode($this->secret), true));
    }
}
