<?php

use App\Http\Controllers\Actions\Coinbase\AddTransactionsAction;
use App\Http\Controllers\Actions\Coinbase\ChartsAction;
use App\Http\Controllers\Actions\Coinbase\CurrentValueAction;
use App\Http\Controllers\Actions\Coinbase\GoalsAction;
use App\Http\Controllers\Actions\CoinMarketCap\Cryptocurrency\GetQuotesBySymbolAction;
use App\Http\Controllers\Actions\CoinMarketCap\Cryptocurrency\ListQuotesAction;
use App\Http\Controllers\Actions\GetCoinsByIdAction;
use App\Http\Controllers\Actions\ListTransactionsAction;
use App\Http\Controllers\Actions\ListCoinsAction;
use App\Http\Controllers\Actions\DashboardAction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardAction::class);
Route::get('/transactions', ListTransactionsAction::class);
Route::get('/transactions/add', AddTransactionsAction::class);
Route::post('/transactions/add', AddTransactionsAction::class);
Route::get('/coins', ListCoinsAction::class);
Route::get('/coin/{id}',GetCoinsByIdAction::class);

/**
 * COINBASE
 */
Route::get('/goals', GoalsAction::class);
Route::get('/currentvalue', CurrentValueAction::class);
Route::get('/charts', ChartsAction::class);

/**
 * COINMARKETCAP
 */
Route::get('/quotes', ListQuotesAction::class);
Route::get('/quote/{symbol}',GetQuotesBySymbolAction::class);
