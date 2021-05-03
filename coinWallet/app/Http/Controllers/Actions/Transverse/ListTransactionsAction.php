<?php


namespace App\Http\Controllers\Actions;

use App\Domain\Repositories\Coinbase\TransactionRepository;
use App\Http\Responders\Coinbase\ListTransactionsResponder;

class ListTransactionsAction
{
    public TransactionRepository $transactions;
    public ListTransactionsResponder $responder;

    public function __construct(TransactionRepository $transactions, ListTransactionsResponder $responder)
    {
        $this->transactions = $transactions;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $transactions = $this->transactions->findAll();

        return $this->responder->send($transactions);
    }
}
