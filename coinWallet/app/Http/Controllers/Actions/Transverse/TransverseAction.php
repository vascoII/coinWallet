<?php


namespace App\Http\Controllers\Actions\Transverse;


use Illuminate\Http\Request;

class TransverseAction
{
    public const COINBASE = 'coinbase';
    public const IN_COINBASE = 'in_coinbase';
    public const BINANCE = 'binance';
    public const IN_BINANCE = 'in_binance';
    public const COINLIST = 'coinlist';
    public const IN_COINLIST = 'in_coinlist';

    public const HUNDRED_MILLION = 100000000;

    protected function init(Request $request): array
    {
        if ($request->is(self::COINBASE . '/*')) {
            $platform = self::COINBASE;
            $in = self::IN_COINBASE;
        } elseif ($request->is(self::BINANCE . '/*')) {
            $platform = self::BINANCE;
            $in = self::IN_BINANCE;
        } else {
            $platform = self::COINLIST;
            $in = self::IN_COINLIST;
        }

        return [$platform, $in];
    }
}
