<?php

namespace App\Infrastructure\Service\Binance;

use App\Domain\Services\Binance\GetBalanceService as GetBalanceServiceInterface;
use GuzzleHttp\Exception\GuzzleException;

class GetBalanceService extends BinanceService implements GetBalanceServiceInterface
{
    public function __invoke()
    {
        $ClassServerTime = $this->restClient->request('GET', 'https://api.binance.com/api/v1/time');
        $CallServerTime = json_decode((string)$ClassServerTime->getBody(), true);
        $Time = $CallServerTime['serverTime'];
        $Timestamp = 'timestamp='.$Time; // build timestamp type url get

        $Signature = $this->signature($Timestamp);
        $BalanceUrl='https://api.binance.com/api/v3/account?timestamp='.$Time.'&signature='.$Signature;

        try {
            $response = $this->restClient->request(
                'GET',
                $BalanceUrl,
                [
                    'headers' => [
                        'X-MBX-APIKEY' => $this->key
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
