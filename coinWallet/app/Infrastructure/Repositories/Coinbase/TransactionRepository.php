<?php


namespace App\Infrastructure\Repositories\Coinbase;

use App\Domain\Collections\Coinbase\TransactionCollection;
use App\Domain\Entities\Coinbase\Transaction;
use App\Domain\Repositories\Coinbase\TransactionRepository as TransactionRepositoryInterface;
use App\Infrastructure\Hydrator\Coinbase\TransactionHydrator;
use App\Infrastructure\Model\Coinbase\TransactionModel;


class TransactionRepository implements TransactionRepositoryinterface
{
    protected TransactionModel $model;
    protected TransactionHydrator $hydrator;

    public const BUY = 'buy';
    public const SELL = 'sell';
    public const EARN = 'earn';
    public const FEES = 'fees';
    public const AMOUNT = 'amount';
    public const EXCHANGE = 'exchange';
    public const TOTAL = 'total';

    public array $type = ['buy', 'earn', 'exchange'];

    public function __construct(TransactionModel $model, TransactionHydrator $hydrator)
    {
        $this->model = $model;
        $this->hydrator = $hydrator;
    }

    public function findAll(): TransactionCollection
    {
        $transactionCollection = new TransactionCollection();
        $collection = $this->model::orderBy('date_hour')->orderBy('date_hour', 'ASC')->get();
        foreach ($collection as $item) {
            $transactionCollection->add($this->hydrator->hydrate($item));
        }
        return $transactionCollection;
    }

    public function findOneBySymbol(string $symbol): Transaction
    {
        $item = $this->model::where(['symbol' => $symbol])->get()->first();
        return $this->hydrator->hydrate($item);
    }

    public function findLastId(): int
    {
        $item = $this->model::orderBy('id', 'DESC')->get()->first();
        if (is_null($item)) {
            return 0;
        }
        return $item->id;
    }

    public function save(Transaction $transaction): void
    {
        $model = new TransactionModel();
        $model->id = $transaction->getId();
        $model->symbol = $transaction->getSymbol();
        $model->type = $transaction->getType();
        $model->reference_code = $transaction->getReferenceCode();
        $model->payment_method = $transaction->getPaymentMethod();
        $model->date_hour = $transaction->getDateHour();
        $model->amount = $transaction->getAmount();
        $model->exchange_rate = $transaction->getExchangeRate();
        $model->sub_total = $transaction->getSubTotal();
        $model->fees = $transaction->getFees();
        $model->total = $transaction->getTotal();

        $model->save();
    }

    public function findAllGroupBySymbol(): TransactionCollection
    {
        $transactionCollection = new TransactionCollection();
        $collection = $this->model::orderBy('date_hour')->orderBy('date_hour', 'ASC')->get();
        $collectionArrayMerged = [];

        foreach ($collection as $item) {
            $res = $this->alreadyAdded($item, $collectionArrayMerged);
            if (!$res) {
                $collectionArrayMerged[] = $item;
            } else {
                $this->addItem($item, $collectionArrayMerged, $res);
            }
        }
        foreach ($collectionArrayMerged as $item) {
            $transactionCollection->add($this->hydrator->hydrate($item));
        }
        return $transactionCollection;
    }

    private function alreadyAdded(TransactionModel $item, array $collectionArrayMerged)
    {
        foreach ($collectionArrayMerged as $key => $model) {
            if ($model->symbol === $item->symbol) {
                return $key;
            }
        }
        return false;
    }

    private function addItem(TransactionModel $item, array $collectionArrayMerged, int $key)
    {
        if ($item->type === Transaction::EARN) {
            $collectionArrayMerged[$key]->amount += $item->amount;
        } elseif ($item->type === Transaction::EXCHANGE) {

        }
    }

    public function findBuyFeesEar(): array
    {
        $res[self::BUY] = $this->model::selectRaw('SUM(total) as ' . self::BUY)
            ->where('type', '=', self::BUY)
            ->get()
            ->first()->buy;

        $res[self::FEES] = $this->model::selectRaw('SUM(fees) as ' . self::FEES)
            ->get()
            ->first()->fees;

        $res[self::EARN] = $this->model::selectRaw('SUM(total) as ' . self::EARN)
            ->where('type', '=', self::EARN)
            ->get()
            ->first()->earn;

        return $res;
    }

    public function findAllAmount(): array
    {
        $result = [];
        $res = $this->model::selectRaw('SUM(amount) as ' . self::AMOUNT)
            ->selectRaw('symbol')
            ->groupBy('symbol')
            ->get();
        foreach($res as $model) {
            $result[$model->symbol] = intval($model->amount);
        }

        return $result;
    }

    public function findAllAmountAndTotal(): array
    {
        $result = [];
        $res = $this->model::selectRaw('SUM(amount) as ' . self::AMOUNT)
            ->selectRaw('SUM(total) as ' . self::TOTAL)
            ->selectRaw('symbol')
            ->groupBy('symbol')
            ->get();
        foreach($res as $model) {
            $result[$model->symbol] = [
                self::AMOUNT => intval($model->amount),
                self::TOTAL => intval($model->total)
            ];
        }

        return $result;
    }

    public function findCurrentWalleteValues(): TransactionCollection
    {
        $transactionCollection = new TransactionCollection();
        $collection = $this->model::select('symbol')
            ->selectRaw('sum(amount) as ' . self::AMOUNT)
            ->selectRaw('AVG(total) as ' . self::TOTAL)
            ->groupBy('symbol')
            ->get();

        foreach ($collection as $item) {
            $transactionCollection->add($this->hydrator->hydratePartial($item));
        }
        return $transactionCollection;
    }

    public function findDistinctCoinsSymbol(): array
    {
        $res = [];
        $collection = $this->model::selectRaw('distinct symbol as symbol')->get();
        foreach ($collection as $item) {
            $res[] = $item->symbol;
        }

        return $res;
    }

    public function findCoinAmountAtTime(string $symbol, string $strtotime): int
    {
        $item = $this->model::selectRaw('SUM(amount) as ' . self::AMOUNT)
            ->where('date_hour', '<', date('Y-m-d H:m:s', $strtotime))
            ->where('symbol', '=', trim($symbol) === 'CELO' ? 'CGLD' : trim($symbol))
            ->groupBy('symbol')
            ->get()
            ->first();

        $itemDefault = $this->model::select('amount')
            ->where('symbol', '=', trim($symbol) === 'CELO' ? 'CGLD' : trim($symbol))
            ->get()
            ->first();
        if (is_null($itemDefault)) {
            echo $symbol; die;
        }
        return $item->amount ?? $itemDefault->amount;
    }
}
