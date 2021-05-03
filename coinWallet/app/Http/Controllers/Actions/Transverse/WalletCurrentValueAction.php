<?php

namespace App\Http\Controllers\Actions\Transverse;

use App\Domain\Entities\Transverse\Transaction;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Repositories\Transverse\TransactionRepository;
use App\Domain\Services\Coinbase\GetBalanceService as CoinbaseGetBalanceService;
use App\Domain\Services\Binance\GetBalanceService as BinanceGetBalanceService;
use App\Domain\Services\Transverse\ValuesDataService;
use App\Http\Responders\Transverse\WalletCurrentValueResponder;
use Illuminate\Http\Request;

class WalletCurrentValueAction extends TransverseAction
{
    public const EXCHANGE_RATE = 'exchangeRate';

    public TransactionRepository $transactions;
    public QuoteRepository $quoteRepository;
    public ValuesDataService $valuesDataService;
    public WalletCurrentValueResponder $responder;
    public CoinbaseGetBalanceService $coinbaseGetBalanceService;
    public BinanceGetBalanceService $binanceGetBalanceService;

    public function __construct(
        TransactionRepository $transactions,
        QuoteRepository $quoteRepository,
        ValuesDataService $valuesDataService,
        CoinbaseGetBalanceService $coinbaseGetBalanceService,
        BinanceGetBalanceService $binanceGetBalanceService,
        WalletCurrentValueResponder $responder
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->transactions = $transactions;
        $this->valuesDataService = $valuesDataService;
        $this->coinbaseGetBalanceService = $coinbaseGetBalanceService;
        $this->binanceGetBalanceService = $binanceGetBalanceService;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        [$platform, $in] = $this->init($request);

        $coinsWallet = $coinsSymbols = $partialData = [];
        $coinsTotal = ['spend' => null, 'transfer' => null, 'value' => null, 'marge' => null];

        $transactionCollection = $this->transactions->findPartial($platform);

        foreach ($transactionCollection->all() as $coin) {
            if ($coin->getPaymentMethod() === 'EUR') {
                $coinsTotal['spend'] += $coin->getTotal() / self::HUNDRED_MILLION;
            } elseif ($coin->getType() === Transaction::TRANSFER) {
                $coinsTotal['transfer'] += $coin->getTotal() / self::HUNDRED_MILLION;
                $coinsTotal['marge'] += $coin->getMarge() / self::HUNDRED_MILLION;
            }
        }
        foreach ($transactionCollection->all() as $coin) {
            $coinsWallet[$coin->getSymbol()] = [];
            $partialData[$coin->getSymbol()] = 0;
            $coinsSymbols[$coin->getSymbol()] = ['spend' => null, 'transfer' => null, 'value' => null, 'marge' => null];
        }
        foreach ($transactionCollection->all() as $coin) {
            $coinsWallet[$coin->getSymbol()][] = [
                'amount' => $coin->getAmount() / self::HUNDRED_MILLION,
                'spend' => in_array($coin->getType(), [Transaction::TRANSFER, Transaction::EARN]) ?
                    0 : round($coin->getTotal() / self::HUNDRED_MILLION, 3),
                'transfer' => $coin->getType() === Transaction::TRANSFER ?
                    round($coin->getTotal() / self::HUNDRED_MILLION, 3) : 0,
                'marge' => $coin->getMarge() / self::HUNDRED_MILLION,
                'date' => substr($coin->getDateHour(), 0, 10),
                'value' => null,
            ];

            $partialData[$coin->getSymbol()] += $coin->getAmount();
        }
        foreach ($coinsWallet as $symbol => $data) {
            if ($partialData[$symbol] === 0) {
                unset($coinsWallet[$symbol]);
                unset($coinsSymbols[$symbol]);
            }
        }
        foreach ($coinsWallet as $symbol => $coin) {
            foreach ($coin as $key => $value) {
                $coinsWallet[$symbol][$key]['value'] = round(
                    $this->quoteRepository->findLastPriceBySymbol($symbol) *
                    $coinsWallet[$symbol][$key]['amount'],
                    3);
            }
        }
        foreach ($coinsWallet as $symbol => $coin) {
            foreach ($coin as $key => $value) {
                $coinsSymbols[$symbol]['spend'] += $value['spend'];
                $coinsSymbols[$symbol]['transfer'] += $value['transfer'];
                $coinsSymbols[$symbol]['marge'] += $value['marge'];
                $coinsSymbols[$symbol]['value'] += $value['value'];

                $coinsTotal['value'] += $value['value'];
            }
        }

        return $this->responder->send($coinsWallet, $coinsSymbols, $coinsTotal, $platform, $in);
    }
}
