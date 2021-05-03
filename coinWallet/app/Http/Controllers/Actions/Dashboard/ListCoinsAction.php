<?php


namespace App\Http\Controllers\Actions;

use App\Domain\Repositories\Coinbase\CoinRepository;
use App\Http\Responders\Coinbase\ListCoinsResponder;

class ListCoinsAction
{
    public CoinRepository $coinRepository;
    public ListCoinsResponder $responder;

    public function __construct(
        CoinRepository $coinRepository,
        ListCoinsResponder $responder,
    ) {
        $this->coinRepository = $coinRepository;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $coins = $this->coinRepository->findAll();

        return $this->responder->send($coins);
    }
}
