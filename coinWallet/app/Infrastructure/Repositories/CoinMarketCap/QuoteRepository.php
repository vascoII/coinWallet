<?php


namespace App\Infrastructure\Repositories\CoinMarketCap;

use App\Domain\Collections\CoinMarketCap\QuoteCollection;
use App\Domain\Entities\CoinMarketCap\Quote;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository as QuoteRepositoryInterface;
use App\Infrastructure\Hydrator\CoinMarketCap\QuoteHydrator;
use App\Infrastructure\Model\CoinMarketCap\QuoteModel;

class QuoteRepository implements QuoteRepositoryInterface
{
    protected QuoteModel $model;
    protected QuoteHydrator $hydrator;

    public function __construct(QuoteModel $model, QuoteHydrator $hydrator)
    {
        $this->model = $model;
        $this->hydrator = $hydrator;
    }
    public function save(Quote $quote): void
    {
        $this->model->symbol = $quote->getSymbol();
        $this->model->currency = $quote->getCurrency();
        $this->model->price = $quote->getPrice();
        $this->model->volume_24h = $quote->getVolume24h();
        $this->model->percent_change_1h = $quote->getPercentChange1h();
        $this->model->percent_change_24h = $quote->getPercentChange24h();
        $this->model->percent_change_7d = $quote->getPercentChange7d();
        $this->model->percent_change_30d = $quote->getPercentChange30d();
        $this->model->percent_change_60d = $quote->getPercentChange60d();
        $this->model->percent_change_90d = $quote->getPercentChange90d();
        $this->model->market_cap = $quote->getMarketCap();
        $this->model->last_updated = $quote->getLastUpdated();
        $this->model->max_supply = $quote->getMaxSupply();
        $this->model->circulating_supply = $quote->getCirculatingSupply();
        $this->model->total_supply = $quote->getTotalSupply();

        $this->model->save();
    }

    public function findAll(): ?QuoteCollection
    {
        $quoteCollection = new QuoteCollection();
        $collection = $this->model::orderBy('last_updated')->get();

        if ($collection->isEmpty()) {
            return null;
        }

        foreach ($collection as $item) {
            $quoteCollection->add($this->hydrator->hydrate($item));
        }
        return $quoteCollection;
    }
}
