<?php


namespace App\Http\Controllers\Actions;

use App\Domain\Repositories\Coinbase\CoinRepository;
use App\Http\Responders\Coinbase\GetCoinsByIdResponder;

class GetCoinsByIdAction
{
    public CoinRepository $coinRepository;
    public GetCoinsByIdResponder $responder;

    public function __construct(
        CoinRepository $coinRepository,
        GetCoinsByIdResponder $responder,
    ) {
        $this->coinRepository = $coinRepository;
        $this->responder = $responder;
    }

    public function __invoke(int $id)
    {
        $coin = $this->coinRepository->findOneById($id);

        return $this->responder->send($coin);
    }
}
