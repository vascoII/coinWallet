<?php


namespace App\Infrastructure\Hydrator\CoinMarketCap;

use App\Domain\Entities\CoinMarketCap\Quote;
use App\Infrastructure\Model\CoinMarketCap\QuoteModel;

class QuoteHydrator
{
    public function hydrate(QuoteModel $quoteModel): ?Quote
    {
        if (is_null($quoteModel)) {
            return null;
        }
        return new Quote(
            $quoteModel->id,
            $quoteModel->symbol,
            $quoteModel->currency,
            $quoteModel->price,
            $quoteModel->volume_24h,
            $quoteModel->percent_change_1h,
            $quoteModel->percent_change_24h,
            $quoteModel->percent_change_7d,
            $quoteModel->percent_change_30d,
            $quoteModel->percent_change_60d,
            $quoteModel->percent_change_90d,
            $quoteModel->market_cap,
            $quoteModel->last_updated,
            $quoteModel->max_supply,
            $quoteModel->circulating_supply,
            $quoteModel->total_supply
        );
    }

    public function hydrateFromCoinMarketCap(array $data): ?Quote
    {
        return new Quote(

            $data['symbol'],
            $data['currency'],
            $data['price'],
            $data['volume_24h'],
            $data['percent_change_1h'],
            $data['percent_change_24h'],
            $data['percent_change_7d'],
            $data['percent_change_30d'],
            $data['percent_change_60d'],
            $data['percent_change_90d'],
            $data['market_cap'],
            $data['last_updated'],
            $data['max_supply'],
            $data['circulating_supply'],
            $data['total_supply']
        );
    }
}
