<?php


namespace App\Infrastructure\Model\Coinbase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class TransactionModel extends Model
{
    use SoftDeletes;

    protected $table = 'transactions';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'symbol',
        'type',
        'referenceCode',
        'paymentMethod',
        'dateHour',
        'amount',
        'exchangeRate',
        'subTotal',
        'fees',
        'total'
    ];

}
