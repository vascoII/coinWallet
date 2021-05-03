<?php


namespace App\Http\Responders\Transverse;

use App\Domain\Collections\Transverse\TransactionCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListTransactionsResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(TransactionCollection $transactions, string $platform, string $in, array $types)
    {
        if ($this->request->expectsJson()) {
            return new JsonResponse([
                'data' => $transactions,
            ]);
        }

        return view('transverse.transactionlist', [
            'transactions' => $transactions->all(),
            'platform' => $platform,
            $in => true,
            'types' => $types
        ]);
    }
}
