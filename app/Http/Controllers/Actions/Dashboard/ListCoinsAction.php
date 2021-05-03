<?php


namespace App\Http\Controllers\Actions\Dashboard;

use App\Domain\Repositories\Transverse\CoinRepository;
use App\Http\Responders\Dashboard\ListCoinsResponder;

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
