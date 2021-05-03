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
                $table->bigInteger('max_supply');
                $table->bigInteger('circulating_supply');
                $table->bigInteger('total_supply');
                $table->bigInteger('is_active');
                $table->bigInteger('cmc_rank');
                $table->bigInteger('is_fiat');
                $table->string('last_updated');
                $table->bigInteger('quote_EUR_price');
                $table->bigInteger('quote_EUR_volume_24h');
                $table->bigInteger('quote_EUR_percent_change_1h');
                $table->bigInteger('quote_EUR_percent_change_24h');
                $table->bigInteger('quote_EUR_percent_change_7d');
                $table->bigInteger('quote_EUR_percent_change_30d');
                $table->bigInteger('quote_EUR_market_cap');
                $table->bigInteger('quote_EUR_last_updated');
                $table->bigInteger('quote_USD_price');
                $table->bigInteger('quote_USD_volume_24h');
                $table->bigInteger('quote_USD_percent_change_1h');
                $table->bigInteger('quote_USD_percent_change_24h');
                $table->bigInteger('quote_USD_percent_change_7d');
                $table->bigInteger('quote_USD_percent_change_30d');
                $table->bigInteger('quote_USD_market_cap');
                $table->bigInteger('quote_USD_last_updated');
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
