<?php


namespace App\Http\Controllers\Actions\Dashboard;

use App\Domain\Repositories\Transverse\CoinRepository;
use App\Http\Responders\Dashboard\GetCoinsByIdResponder;

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
