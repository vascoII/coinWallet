<?php

use App\Http\Controllers\Actions\Coinbase\ListTransactionsAction;
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

/**
 * COINBASE
 */
Route::get('/coinbase/transactions', ListTransactionsAction::class);
