<?php


namespace App\Http\Controllers\Actions\Coinbase;


use App\Domain\Entities\Coinbase\Transaction;
use App\Domain\Repositories\Coinbase\CoinRepository;
use App\Domain\Repositories\Coinbase\TransactionRepository;
use App\Http\Controllers\Actions\ListTransactionsAction;
use App\Http\Responders\Coinbase\AddTransactionsResponder;
use App\Infrastructure\Hydrator\Coinbase\TransactionHydrator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AddTransactionsAction
{
    public const EXCHANGE = 'exchange';
    public array $platform = [
        'binance' => 'binance',
        'coinbase' => 'coinbase'
    ];

    public TransactionRepository $transactionRepository;
    public TransactionHydrator $transactionHydrator;
    public AddTransactionsResponder $responder;
    public CoinRepository $coinRepository;

    public function __construct(
        TransactionRepository $transactionRepository,
        TransactionHydrator $transactionHydrator,
        AddTransactionsResponder $responder,
        CoinRepository $coinRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->transactionHydrator = $transactionHydrator;
        $this->responder = $responder;
        $this->coinRepository = $coinRepository;
    }

    public function __invoke(Request $request)
    {
        $nextId = $this->transactionRepository->findLastId() + 1;
        $coinSymbolList = $this->coinRepository->findAllSymbol();

        if ($request->isMethod('post')) {
            $transactionCollection = $this->transactionHydrator->hydrateFromRequest($request->all());
            foreach ($transactionCollection->all() as $transaction) {
                $this->transactionRepository->save($transaction);
            }
            return redirect()->action([ListTransactionsAction::class]);
        }

        return $this->responder->send(
            $nextId,
            [
                Transaction::BUY,
                Transaction::EARN,
                Transaction::EXCHANGE,
                Transaction::SELL
            ],
            (string) Str::uuid(),
            $coinSymbolList,
            $this->platform
        );
    }

}
