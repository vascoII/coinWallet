<?php

namespace App\Infrastructure\Service\Coinbase;

use App\Domain\Services\Coinbase\GetBalanceService as GetBalanceServiceInterface;
use GuzzleHttp\Exception\GuzzleException;

class GetBalanceService extends CoinbaseService implements GetBalanceServiceInterface
{
    const URI = '/accounts';

    public function __invoke()
    {
        $date = new \DateTime();
        try {
            $response = $this->restClient->request(
                'GET',
                $this->basePath . self::URI,
                [
                    'headers' => [
                        'CB-ACCESS-KEY' => $this->key,
                        'CB-ACCESS-SIGN' => $this->signature(
                            $request_path = $this->basePath . self::URI,
                            $body = '',
                            $timestamp = $date->getTimestamp(),
                            $method='GET'
                        ),
                        'CB-ACCESS-TIMESTAMP' => $this->key,
                        'CB-ACCESS-PASSPHRASE' => ''
                    ]
                ]
            );
        } catch (GuzzleException $e) {
            echo $e->getMessage(); die;
        }

        $res = json_decode((string)$response->getBody(), true);
        echo '<pre>'; var_dump($res); echo '</pre>'; die;
    }
}
