<?php

namespace App\Http\Controllers\Actions\Transverse;

use App\Domain\Entities\Transverse\Transaction;
use App\Domain\Repositories\Transverse\CoinRepository;
use App\Domain\Repositories\Transverse\TransactionRepository;
use App\Http\Responders\Transverse\AddTransactionsResponder;
use App\Infrastructure\Hydrator\Transverse\TransactionHydrator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AddTransactionsAction extends TransverseAction
{
    public const EXCHANGE = 'exchange';

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
        [$platform, $in] = $this->init($request);
        $nextId = $this->transactionRepository->findLastId() + 1;
        $coinSymbolList = $this->transactionRepository->findAllSymbol($platform);

        if ($request->isMethod('post')) {
            $transactionCollection = $this->transactionHydrator->hydrateFromRequest($request->all());
            foreach ($transactionCollection->all() as $transaction) {
                $this->transactionRepository->save($transaction);
            }
            return redirect()->action([ListTransactionsAction::class], ['platform' => $platform]);
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
            $platform,
            $in
        );
    }

}
