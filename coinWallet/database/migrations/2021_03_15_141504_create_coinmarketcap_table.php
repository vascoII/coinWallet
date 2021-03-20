<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinmarketCapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('coinmarketcap')) {
            Schema::create('coinmarketcap', function (Blueprint $table) {
                $table->id();
                $table->string('symbol');
                $table->integer('max_supply');
                $table->integer('circulating_supply');
                $table->integer('total_supply');
                $table->integer('is_active');
                $table->integer('cmc_rank');
                $table->integer('is_fiat');
                $table->string('last_updated');
                $table->float('quote_EUR_price');
                $table->float('quote_EUR_volume_24h');
                $table->float('quote_EUR_percent_change_1h');
                $table->float('quote_EUR_percent_change_24h');
                $table->float('quote_EUR_percent_change_7d');
                $table->float('quote_EUR_percent_change_30d');
                $table->float('quote_EUR_market_cap');
                $table->integer('quote_EUR_last_updated');
                $table->float('quote_USD_price');
                $table->float('quote_USD_volume_24h');
                $table->float('quote_USD_percent_change_1h');
                $table->float('quote_USD_percent_change_24h');
                $table->float('quote_USD_percent_change_7d');
                $table->float('quote_USD_percent_change_30d');
                $table->float('quote_USD_market_cap');
                $table->integer('quote_USD_last_updated');
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
        Schema::dropIfExists('coinmarket');
    }
}
