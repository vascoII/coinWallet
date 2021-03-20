<?php


namespace App\Infrastructure\Service\CoinMarketCap;


use App\Domain\Entities\Coinbase\Coin;
use App\Domain\Services\MetaDataService;
use GuzzleHttp\Exception\GuzzleException;

class MetaDataCoinMarketCapService extends CoinMarketCapService implements MetaDataService
{
    const URI = 'v1/cryptocurrency/info?symbol=';

    public function __invoke(string $symbol): Coin
    {
        try {
            $response = $this->restClient->request(
                'GET',
                $this->basePath . self::URI . $symbol,
                [
                    'headers' => [
                        'X-CMC_PRO_API_KEY' => $this->apiKey
                    ]
                ]
            );

            if ($response->getStatusCode() != 200) {

            }

            $res = json_decode((string)$response->getBody(), true);
            return $this->coinHydrator->hydrateFromCoinbase($res['data'][$symbol]);
        } catch (GuzzleException $e) {
        }
    }
}
