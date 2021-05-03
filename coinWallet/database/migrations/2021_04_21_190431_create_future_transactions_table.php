<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFutureTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('future_transactions');
        if (!Schema::hasTable('future_transactions')) {
            Schema::create('future_transactions', function (Blueprint $table) {
                $table->id();
                $table->string('symbol');
                $table->string('reference_code')->unique();
                $table->bigInteger('amount');
                $table->bigInteger('exchange_rate');
                $table->bigInteger('total');
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
        Schema::dropIfExists('future_transactions');
    }
}
