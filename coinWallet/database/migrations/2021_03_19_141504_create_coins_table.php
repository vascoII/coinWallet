<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('quotes');
        if (!Schema::hasTable('quotes')) {
            Schema::create('quotes', function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->string('symbol');
                $table->string('currency');
                $table->float('price');
                $table->string('volume_24h');
                $table->string('percent_change_1h');
                $table->string('percent_change_24h');
                $table->string('percent_change_7d');
                $table->string('percent_change_30d');
                $table->string('percent_change_60d');
                $table->string('percent_change_90d');
                $table->string('market_cap');
                $table->string('last_updated');
                $table->string('max_supply')->nullable();
                $table->string('circulating_supply')->nullable();
                $table->string('total_supply')->nullable();
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
        Schema::dropIfExists('quotes');
    }
}
