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

    public const VALUE = 'value';
    const HUNDRED_MILLION = 100000000;
    public array $celo = ['CGLD' => 'CELO'];

    public function __construct(QuoteModel $model, QuoteHydrator $hydrator)
    {
        $this->model = $model;
        $this->hydrator = $hydrator;
    }
    public function save(Quote $quote): void
    {
        $model = new QuoteModel();
        $model->id = $quote->getId();
        $model->symbol = $quote->getSymbol();
        $model->currency = $quote->getCurrency();
        $model->price = $quote->getPrice();
        $model->volume_24h = $quote->getVolume24h();
        $model->percent_change_1h = $quote->getPercentChange1h();
        $model->percent_change_24h = $quote->getPercentChange24h();
        $model->percent_change_7d = $quote->getPercentChange7d();
        $model->percent_change_30d = $quote->getPercentChange30d();
        $model->percent_change_60d = $quote->getPercentChange60d();
        $model->percent_change_90d = $quote->getPercentChange90d();
        $model->market_cap = $quote->getMarketCap();
        $model->last_updated = $quote->getLastUpdated();
        $model->max_supply = $quote->getMaxSupply();
        $model->circulating_supply = $quote->getCirculatingSupply();
        $model->total_supply = $quote->getTotalSupply();

        $model->save();
    }

    public function findAll(): ?QuoteCollection
    {
        $quoteCollection = new QuoteCollection();
        $collection = $this->model::orderBy('symbol')->orderBy('last_updated')->get();

        if ($collection->isEmpty()) {
            return null;
        }

        foreach ($collection as $item) {
            $quoteCollection->add($this->hydrator->hydrate($item));
        }
        return $quoteCollection;
    }

    public function findLastId(): int
    {
        return is_null($this->model::orderBy('id', 'desc')->get()->first()) ?
            -1 : $this->model::orderBy('id', 'desc')->get()->first()->id;
    }

    public function findLast(int $countCoins): ?QuoteCollection
    {
        $quoteCollection = new QuoteCollection();
        $collection = $this->model::where(['currency' => 'EUR'])->orderBy('last_updated', 'DESC')->limit($countCoins)->get();

        if ($collection->isEmpty()) {
            return null;
        }

        foreach ($collection as $item) {
            $quoteCollection->add($this->hydrator->hydrate($item));
        }
        return $quoteCollection;
    }

    public function findHistoryBySymbol(string $symbol, string $currency = 'EUR'): ?QuoteCollection
    {
        $quoteCollection = new QuoteCollection();
        $collection = $this->model::where(['symbol' => $symbol, 'currency' => $currency])
            ->orderBy('last_updated', 'desc')
            ->get();

        if ($collection->isEmpty()) {
            return null;
        }

        foreach ($collection as $item) {
            $quoteCollection->add($this->hydrator->hydrate($item));
        }
        return $quoteCollection;
    }

    public function findLastValues(array $amount): array
    {
        $result = [];
        foreach ($amount as $key => $value) {
            $price = $this->model::select('price')
                ->where(['currency' => 'EUR'])
                ->where (['symbol' => array_key_exists($key, $this->celo) ? $this->celo[$key] : $key])
                ->orderBy('last_updated', 'desc')
                ->get()
                ->first();
            $result[$key] = $price->price;
        }

        return $result;
    }

    public function findFirstValues(string $symbol): Quote
    {
        $quoteModel = $this->model::where(['currency' => 'EUR'])
            ->where (['symbol' => array_key_exists($symbol, $this->celo) ? $this->celo[$symbol] : $symbol])
            ->orderBy('last_updated', 'asc')
            ->get()
            ->first();

        return $this->hydrator->hydrate($quoteModel);
    }

    public function findValueOverTime(): array
    {
        $res = [];
        $collection = $this->model::selectRaw('last_updated as date')
            ->selectRaw('GROUP_CONCAT(CONCAT(symbol, ":", price) SEPARATOR ", ") as data')
            ->selectRaw('symbol as symbol')
            ->where('currency', '=', 'EUR')
            ->groupBy('date')
            ->get();
        foreach ($collection as $item) {
                $res[] = ['date' => strtotime($item->date), 'data' => $item->data];
        }
        return $res;
    }

    public function findAllBySymbolDate(): array
    {
        $res = [];
        $subRes = [];
        $subSubRes = [];

        $symbols = $this->model::select('symbol')
            ->orderBy('symbol')
            ->orderBy('last_updated')
            ->get();
        foreach ($symbols as $symbol) {
            $subRes[] = $symbol->symbol;
        }

        foreach ($subRes as $row) {
            $collection = $this->model::select('symbol')
                ->select('price')
                ->selectRaw('CONCAT(substring(last_updated, 1, 13), ":00") as date')
                ->where('currency', '=', 'EUR')
                ->where('symbol', '=', $row)
                ->orderBy('last_updated')
                ->get();
            foreach ($collection as $item) {
                $subSubRes[] = [
                    'price' => round($item->price / self::HUNDRED_MILLION, 2),
                    'date' => $item->date
                ];
            }
            $res[$row] = $subSubRes;
            unset($subSubRes);
        }

        return $res;
    }
}
