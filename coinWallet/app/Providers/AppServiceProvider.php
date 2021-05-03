<?php

namespace App\Providers;

use App\Domain\Repositories\Transverse\TransactionRepository as TransactionRepositoryInterface;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository as QuoteRepositoryInterface;
use App\Domain\Repositories\Transverse\CoinRepository as CoinRepositoryInterface;
use App\Domain\Services\Coinbase\GetAlertInfoService as GetAlertInfoServiceInterface;
use App\Domain\Services\CoinMarketCap\QuoteLatestService as QuoteLatestServiceInterface;
use App\Domain\Services\MetaDataService as MetaDataServiceInterface;
use App\Domain\Services\Coinbase\GetBalanceService as CoinbaseGetBalanceServiceInterface;
use App\Domain\Services\Binance\GetBalanceService as BinanceGetBalanceServiceInterface;
use App\Infrastructure\Repositories\Transverse\CoinRepository;
use App\Infrastructure\Repositories\Transverse\TransactionRepository;
use App\Infrastructure\Repositories\CoinMarketCap\QuoteRepository;
use App\Infrastructure\Service\Coinbase\GetAlertInfoService;
use App\Infrastructure\Service\Coinbase\GetBalanceService as CoinbaseGetBalanceService;
use App\Infrastructure\Service\Binance\GetBalanceService as BinanceGetBalanceService;
use App\Infrastructure\Service\CoinMarketCap\MetaDataCoinMarketCapService;
use App\Infrastructure\Service\CoinMarketCap\QuoteLatestService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /** REPOSITORY */
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(CoinRepositoryInterface::class, CoinRepository::class);
        $this->app->bind(QuoteRepositoryInterface::class, QuoteRepository::class);

        /** SERVICE */
        $this->app->bind(MetaDataServiceInterface::class, MetaDataCoinMarketCapService::class);
        $this->app->bind(QuoteLatestServiceInterface::class, QuoteLatestService::class);
        $this->app->bind(GetAlertInfoServiceInterface::class, GetAlertInfoService::class);
        $this->app->bind(CoinbaseGetBalanceServiceInterface::class, CoinbaseGetBalanceService::class);
        $this->app->bind(BinanceGetBalanceServiceInterface::class, BinanceGetBalanceService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
