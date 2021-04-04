<?php


namespace App\Infrastructure\Service\CoinMarketCap;

use App\Domain\Collections\CoinMarketCap\QuoteCollection;
use App\Domain\Services\CoinMarketCap\QuoteLatestService as QuoteLatestServiceInterface;
use GuzzleHttp\Exception\GuzzleException;

class QuoteLatestService extends CoinMarketCapService implements QuoteLatestServiceInterface
{
    const URI = 'v1/cryptocurrency/quotes/latest?symbol=' ;
    const CONVERT = '&convert=EUR';

    public function __invoke(array $symbols, int $latestId): QuoteCollection
    {
        $uriRaw = self::URI . implode(',', $symbols);
        $uriConvert = $uriRaw . self::CONVERT;
        $key = 1;
        try {
            $responseRaw = $this->restClient->request(
                'GET',
                $this->basePath . $uriRaw,
                [
                    'headers' => [
                        'X-CMC_PRO_API_KEY' => $this->apiKey
                    ]
                ]
            );

            if ($responseRaw->getStatusCode() != 200) {

            }
            $resRaw = json_decode((string)$responseRaw->getBody(), true);

            $responseConvert = $this->restClient->request(
                'GET',
                $this->basePath . $uriConvert,
                [
                    'headers' => [
                        'X-CMC_PRO_API_KEY' => $this->apiKey
                    ]
                ]
            );

            if ($responseConvert->getStatusCode() != 200) {

            }
            $resConvert = json_decode((string)$responseConvert->getBody(), true);

            $quoteCollection = new QuoteCollection();

            foreach ($symbols as $symbol) {
                $resultRaw = $resRaw['data'][$symbol]['quote']['USD'];
                $resultConvert = $resConvert['data'][$symbol]['quote']['EUR'];
                $resUSD = [
                    'id' => $latestId + $key,
                    'symbol' => $resRaw['data'][$symbol]['symbol'],
                    'currency' => 'USD',
                    'max_supply' => $resRaw['data'][$symbol]['max_supply'],
                    'circulating_supply' => $resRaw['data'][$symbol]['circulating_supply'],
                    'total_supply' => $resRaw['data'][$symbol]['total_supply']
                ];
                $quoteCollection->add($this->quoteHydrator->hydrateFromCoinMarketCap(array_merge($resultRaw, $resUSD)));

                $resEUR = [
                    'id' => $latestId + $key + 1,
                    'symbol' => $resRaw['data'][$symbol]['symbol'],
                    'currency' => 'EUR',
                    'max_supply' => $resRaw['data'][$symbol]['max_supply'],
                    'circulating_supply' => $resRaw['data'][$symbol]['circulating_supply'],
                    'total_supply' => $resRaw['data'][$symbol]['total_supply']
                ];
                $quoteCollection->add(
                    $this->quoteHydrator->hydrateFromCoinMarketCap(array_merge($resultConvert, $resEUR))
                );
                $key = $key + 2;
            }
        } catch (GuzzleException $e) {

        }

        return $quoteCollection;
    }
}
