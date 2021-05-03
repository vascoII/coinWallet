<?php

use App\Http\Controllers\Actions\Dashboard\DashboardAction;
use App\Http\Controllers\Actions\Dashboard\ListCoinsAction;
use App\Http\Controllers\Actions\Dashboard\GetCoinsByIdAction;
use App\Http\Controllers\Actions\Transverse\ListTransactionsAction;
use App\Http\Controllers\Actions\Transverse\AddTransactionsAction;
use App\Http\Controllers\Actions\Transverse\CoinsCurrentValueAction;
use App\Http\Controllers\Actions\Transverse\WalletCurrentValueAction;
use App\Http\Controllers\Actions\Transverse\ChartsAction;
use App\Http\Controllers\Actions\Transverse\SellsAction;
use App\Http\Controllers\Actions\CoinMarketCap\Cryptocurrency\GetQuotesBySymbolAction;
use App\Http\Controllers\Actions\CoinMarketCap\Cryptocurrency\ListQuotesAction;

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
Route::get('/coins', ListCoinsAction::class);
Route::get('/coin/{id}',GetCoinsByIdAction::class);

/**
 * COINBASE
 */
Route::get('/coinbase/transactions', ListTransactionsAction::class);
Route::get('/coinbase/transactions/add', AddTransactionsAction::class);
Route::post('/coinbase/transactions/add', AddTransactionsAction::class);
Route::get('/coinbase/coinscurrentvalue', CoinsCurrentValueAction::class);
Route::get('/coinbase/walletcurrentvalue', WalletCurrentValueAction::class);
Route::get('/coinbase/sells', SellsAction::class);
Route::get('/coinbase/charts', ChartsAction::class);

/**
 * BINANCE
 */
Route::get('/binance/transactions', ListTransactionsAction::class);
Route::get('/binance/transactions/add', AddTransactionsAction::class);
Route::post('/binance/transactions/add', AddTransactionsAction::class);
Route::get('/binance/coinscurrentvalue', CoinsCurrentValueAction::class);
Route::get('/binance/walletcurrentvalue', WalletCurrentValueAction::class);
Route::get('/binance/sells', SellsAction::class);
Route::get('/binance/charts', ChartsAction::class);

/**
 * COINLIST
 */
Route::get('/coinlist/transactions', ListTransactionsAction::class);
Route::get('/coinlist/transactions/add', AddTransactionsAction::class);
Route::post('/coinlist/transactions/add', AddTransactionsAction::class);
Route::get('/coinlist/coinscurrentvalue', CoinsCurrentValueAction::class);
Route::get('/coinlist/walletcurrentvalue', WalletCurrentValueAction::class);
Route::get('/coinlist/sells', SellsAction::class);
Route::get('/coinlist/charts', ChartsAction::class);

/**
 * COINMARKETCAP
 */
Route::get('/quotes', ListQuotesAction::class);
Route::get('/quote/{symbol}',GetQuotesBySymbolAction::class);
