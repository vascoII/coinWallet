<?php


namespace App\Infrastructure\Model\CoinMarketCap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteModel extends Model
{
    use SoftDeletes;

    protected $table = 'quotes';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'symbol',
        'currency',
        'price',
        'volume24h',
        'percent_change_1h',
        'percent_change_24h',
        'percent_change_7d',
        'percent_change_30d',
        'percent_change_60d',
        'percent_change_90d',
        'market_cap',
        'last_updated',
        'max_supply',
        'circulating_supply',
        'total_supply'
    ];

}
