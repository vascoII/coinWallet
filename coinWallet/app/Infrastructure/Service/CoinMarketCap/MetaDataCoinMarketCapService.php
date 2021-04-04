<?php


namespace App\Infrastructure\Service\CoinMarketCap;

use App\Domain\Entities\Coinbase\Coin;
use App\Domain\Exceptions\CoinMarketCap\MetaDataCoinMarketCapNotFound;
use App\Domain\Services\MetaDataService;
use GuzzleHttp\Exception\GuzzleException;

class MetaDataCoinMarketCapService extends CoinMarketCapService implements MetaDataService
{
    const URI = 'v1/cryptocurrency/info?symbol=';

    public array $convert = ['CGLD' => 'CELO'];

    public function __invoke(string $symbol): Coin
    {
        if (array_key_exists($symbol, $this->convert)) {
            $symbol = $this->convert[$symbol];
        }
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
        } catch (GuzzleException $e) {
            throw new MetaDataCoinMarketCapNotFound($symbol, $e->getCode());
        }

        $res = json_decode((string)$response->getBody(), true);
        return $this->coinHydrator->hydrateFromCoinbase($res['data'][$symbol]);
    }
}
