<?php


namespace App\Domain\Exceptions\CoinMarketCap;

use \Exception;
use Throwable;

class MetaDataCoinMarketCapNotFound extends Exception
{
    public function __construct(string $message, int $code, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
