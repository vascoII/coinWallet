<?php


namespace App\Infrastructure\Hydrator\CoinMarketCap;

use App\Domain\Entities\CoinMarketCap\Quote;
use App\Infrastructure\Model\CoinMarketCap\QuoteModel;

class QuoteHydrator
{
    const HUNDRED_MILLION = 100000000;

    public function hydrate(QuoteModel $quoteModel): ?Quote
    {
        if (is_null($quoteModel)) {
            return null;
        }
        return new Quote(
            $quoteModel->id,
            $quoteModel->symbol,
            $quoteModel->currency,
            $quoteModel->price / self::HUNDRED_MILLION,
            $quoteModel->volume_24h / self::HUNDRED_MILLION,
            $quoteModel->percent_change_1h,
            $quoteModel->percent_change_24h / self::HUNDRED_MILLION,
            $quoteModel->percent_change_7d / self::HUNDRED_MILLION,
            $quoteModel->percent_change_30d / self::HUNDRED_MILLION,
            $quoteModel->percent_change_60d / self::HUNDRED_MILLION,
            $quoteModel->percent_change_90d / self::HUNDRED_MILLION,
            $quoteModel->market_cap / self::HUNDRED_MILLION,
            $quoteModel->last_updated,
            $quoteModel->max_supply / self::HUNDRED_MILLION,
            $quoteModel->circulating_supply / self::HUNDRED_MILLION,
            $quoteModel->total_supply / self::HUNDRED_MILLION
        );
    }

    public function hydrateFromCoinMarketCap(array $data): ?Quote
    {
        return new Quote(
            $data['id'],
            $data['symbol'],
            $data['currency'],
            $data['price'] * self::HUNDRED_MILLION,
            $data['volume_24h'] * self::HUNDRED_MILLION,
            $data['percent_change_1h'] * self::HUNDRED_MILLION,
            $data['percent_change_24h'] * self::HUNDRED_MILLION ,
            $data['percent_change_7d'] * self::HUNDRED_MILLION,
            $data['percent_change_30d'] * self::HUNDRED_MILLION,
            $data['percent_change_60d'] * self::HUNDRED_MILLION,
            $data['percent_change_90d'] * self::HUNDRED_MILLION,
            $data['market_cap'] * self::HUNDRED_MILLION,
            $data['last_updated'],
            $data['max_supply'] * self::HUNDRED_MILLION,
            $data['circulating_supply'] * self::HUNDRED_MILLION,
            $data['total_supply'] * self::HUNDRED_MILLION
        );
    }
}
