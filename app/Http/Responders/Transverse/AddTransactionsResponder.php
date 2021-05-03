<?php


namespace App\Http\Responders\Transverse;

use Illuminate\Http\Request;

class AddTransactionsResponder
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function send(
        int $nextId,
        array $typeTransaction,
        string $defaultGenerateCode,
        array $coinSymbolList,
        string $platform,
        string $in
    ) {
        return view('transverse.transactionadd', [
            'id' => $nextId,
            'typeTransaction' => $typeTransaction,
            'defaultGenerateCode' => $defaultGenerateCode,
            'coinSymbolList' => $coinSymbolList,
            'platform' => $platform,
            $in => true
        ]);
    }
}
