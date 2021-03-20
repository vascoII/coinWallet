<?php


namespace App\Domain\Services;


use App\Domain\Entities\Coinbase\Coin;

interface MetaDataService
{
    /**
     * @param string $symbol
     * @return Coin
     */
    public function __invoke(string $symbol): Coin;
}
