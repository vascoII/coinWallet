<?php


namespace App\Http\Responders\Coinbase;

use App\Domain\Collections\Coinbase\TransactionCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListTransactionsResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(TransactionCollection $transactions)
    {
        if ($this->request->expectsJson()) {
            return new JsonResponse([
                'data' => $transactions,
            ]);
        }

        return view('transactions.list', ['transactions' => $transactions->all()]);
    }
}
