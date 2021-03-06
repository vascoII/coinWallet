<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('transactions')) {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->string('symbol');
                $table->enum('type', ['buy', 'sell', 'earn', 'exchange', 'transfer']);
                $table->string('reference_code')->unique();
                $table->string('payment_method')->nullable();
                $table->dateTime('date_hour');
                $table->bigInteger('amount');
                $table->bigInteger('exchange_rate');
                $table->string('platform');
                $table->bigInteger('sub_total');
                $table->bigInteger('fees');
                $table->bigInteger('total');
                $table->bigInteger('marge');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
