<?php


namespace App\Http\Controllers\Actions\Transverse;

use App\Domain\Entities\Transverse\Transaction;
use App\Domain\Repositories\Transverse\TransactionRepository;
use App\Http\Responders\Transverse\ListTransactionsResponder;
use Illuminate\Http\Request;

class ListTransactionsAction extends TransverseAction
{
    public TransactionRepository $transactions;
    public ListTransactionsResponder $responder;

    public function __construct(TransactionRepository $transactions, ListTransactionsResponder $responder)
    {
        $this->transactions = $transactions;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        [$platform, $in] = $this->init($request);
        $transactions = $this->transactions->findAll($platform);

        return $this->responder->send($transactions, $platform, $in, Transaction::TYPE);
    }
}
