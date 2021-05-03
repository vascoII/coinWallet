<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            [
                'symbol' => 'ETH',
                'type' => 'buy',
                'reference_code' => 'XAV3SD7V',
                'payment_method' => 'Portefeuille en Euro',
                'date_hour' => '2021-02-18 14:27',
                'amount' => 30503653,
                'exchange_rate' => 161509000000,
                'sub_total' => 49266000000,
                'fees' => 734000000,
                'total' => 50000000000
            ], [
                'symbol' => 'GRT',
                'type' => 'buy',
                'reference_code' => 'D9UAJGMP',
                'payment_method' => 'Portefeuille en Euro',
                'date_hour' => '2021-02-18 14:28',
                'amount' => 26055541364,
                'exchange_rate' => 189080000,
                'sub_total' => 49266000000,
                'fees' => 734000000,
                'total' => 50000000000
            ], [
                'symbol' => 'XLM',
                'type' => 'buy',
                'reference_code' => 'C8VZ7TW9',
                'payment_method' => 'Portefeuille en Euro',
                'date_hour' => '2021-02-18 14:30',
                'amount' => 47293886930,
                'exchange_rate' => 041660000,
                'sub_total' => 19701000000,
                'fees' => 299000000,
                'total' => 20000000000
            ], [
                'symbol' => 'DASH',
                'type' => 'buy',
                'reference_code' => 'XV3VDA8M',
                'payment_method' => 'Portefeuille en Euro',
                'date_hour' => '2021-02-18 14:34',
                'amount' => 82085440,
                'exchange_rate' => 24001000000,
                'sub_total' => 19701000000,
                'fees' => 299000000,
                'total' => 20000000000
            ], [
                'symbol' => 'BTC',
                'type' => 'buy',
                'reference_code' => 'Y5UEAEEC',
                'payment_method' => 'Portefeuille en Euro',
                'date_hour' => '2021-02-18 14:35',
                'amount' => 2739101,
                'exchange_rate' => 4316672000000,
                'sub_total' => 118238000000,
                'fees' => 1762000000,
                'total' => 120000000000
            ]
        ];

        foreach ($transactions as $transaction) {
            DB::table('transactions')->insert($transaction);
        }
    }
}
