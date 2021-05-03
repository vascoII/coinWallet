<?php


namespace App\Infrastructure\Model\Transverse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'total',
        'marge'
    ];

}
