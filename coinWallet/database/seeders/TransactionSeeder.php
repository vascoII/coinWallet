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
                'amount' => 0.30503653,
                'exchange_rate' => 1615.09,
                'sub_total' => 49266,
                'fees' => 734,
                'total' => 50000
            ], [
                'symbol' => 'GRT',
                'type' => 'buy',
                'reference_code' => 'D9UAJGMP',
                'payment_method' => 'Portefeuille en Euro',
                'date_hour' => '2021-02-18 14:28',
                'amount' => 260.55541364,
                'exchange_rate' => 1.8908,
                'sub_total' => 49266,
                'fees' => 734,
                'total' => 50000
            ], [
                'symbol' => 'XLM',
                'type' => 'buy',
                'reference_code' => 'C8VZ7TW9',
                'payment_method' => 'Portefeuille en Euro',
                'date_hour' => '2021-02-18 14:30',
                'amount' => 472.9388693,
                'exchange_rate' => 0.4166,
                'sub_total' => 197.01,
                'fees' => 299,
                'total' => 20000
            ], [
                'symbol' => 'DASH',
                'type' => 'buy',
                'reference_code' => 'XV3VDA8M',
                'payment_method' => 'Portefeuille en Euro',
                'date_hour' => '2021-02-18 14:34',
                'amount' => 0.82085440,
                'exchange_rate' => 240.01,
                'sub_total' => 197.01,
                'fees' => 299,
                'total' => 20000
            ], [
                'symbol' => 'BTC',
                'type' => 'buy',
                'reference_code' => 'Y5UEAEEC',
                'payment_method' => 'Portefeuille en Euro',
                'date_hour' => '2021-02-18 14:35',
                'amount' => 0.02739101,
                'exchange_rate' => 43166.72,
                'sub_total' => 1182.38,
                'fees' => 1762,
                'total' => 120000
            ]
        ];

        foreach ($transactions as $transaction) {
            DB::table('transactions')->insert($transaction);
        }
    }
}
