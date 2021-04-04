<?php


namespace App\Http\Responders\Coinbase;


use Illuminate\Http\Request;

class AddTransactionsResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(int $nextId, array $typeTransaction, string $defaultGenerateCode, array $coinSymbolList)
    {
        return view('transactions.add', [
            'id' => $nextId,
            'typeTransaction' => $typeTransaction,
            'defaultGenerateCode' => $defaultGenerateCode,
            'coinSymbolList' => $coinSymbolList
        ]);
    }
}
