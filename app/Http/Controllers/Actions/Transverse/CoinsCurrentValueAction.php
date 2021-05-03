<?php

namespace App\Http\Controllers\Actions\Transverse;

use App\Domain\Entities\Transverse\Transaction;
use App\Domain\Repositories\Transverse\TransactionRepository;
use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Services\Transverse\ValuesDataService;
use App\Http\Responders\Transverse\CoinsCurrentValueResponder;
use Illuminate\Http\Request;

class CoinsCurrentValueAction extends TransverseAction
{
    public const EUR = 'EUR';
    public const DOLLAR = ' $';
    public const EURO = ' €';

    public TransactionRepository $transactions;
    public QuoteRepository $quoteRepository;
    public ValuesDataService $valuesDataService;
    public CoinsCurrentValueResponder $responder;

    public function __construct(
        TransactionRepository $transactions,
        QuoteRepository $quoteRepository,
        ValuesDataService $valuesDataService,
        CoinsCurrentValueResponder $responder
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->transactions = $transactions;
        $this->valuesDataService = $valuesDataService;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        [$platform, $in] = $this->init($request);
        $coinsWallet = $coinsSymbols = $partialData = [];
        $fiat = $request->input('fiat') ?? self::EUR;

        $transactionCollection = $this->transactions->findPartial($platform);
        foreach ($transactionCollection->all() as $coin) {
            $coinsWallet[$coin->getSymbol()] = [];
            $partialData[$coin->getSymbol()] = 0;
            $coinsSymbols[$coin->getSymbol()] = [
                'spend' => null, 'transfer' => null, 'value' => null, 'amount' => null, 'current_rate' => null,
                'marge' => null
            ];
        }
        foreach ($transactionCollection->all() as $coin) {
            $coinsWallet[$coin->getSymbol()][] = [
                'amount' => $coin->getAmount(),
                'date' => substr($coin->getDateHour(), 0, 10),
                'value' => null,
                'current_rate' => null
            ];
            if ($coin->getType() !== Transaction::TRANSFER) {
                $coinsSymbols[$coin->getSymbol()]['spend'] += $coin->getTotal();
            } else {
                $coinsSymbols[$coin->getSymbol()]['transfer'] += $coin->getTotal();
                $coinsSymbols[$coin->getSymbol()]['marge'] += $coin->getMarge();
            }
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
                $coinsWallet[$symbol][$key]['value'] =
                    $this->quoteRepository->findLastPriceBySymbol($symbol, $fiat) *
                    $coinsWallet[$symbol][$key]['amount'];
                $coinsWallet[$symbol][$key]['current_rate'] =
                    $this->quoteRepository->findLastPriceBySymbol($symbol, $fiat);
            }
        }
        foreach ($coinsWallet as $symbol => $coin) {
            foreach ($coin as $value) {
                $coinsSymbols[$symbol]['amount'] += $value['amount'];
                $coinsSymbols[$symbol]['value'] += $value['value'];
                $coinsSymbols[$symbol]['current_rate'] = $value['current_rate'];
            }
            $coinsSymbols[$symbol]['spend'] = $coinsSymbols[$symbol]['spend'] / self::HUNDRED_MILLION;
            $coinsSymbols[$symbol]['transfer'] = $coinsSymbols[$symbol]['transfer'] / self::HUNDRED_MILLION;
            $coinsSymbols[$symbol]['marge'] = $coinsSymbols[$symbol]['marge'] / self::HUNDRED_MILLION;
            $coinsSymbols[$symbol]['amount'] = $coinsSymbols[$symbol]['amount'] / self::HUNDRED_MILLION;
            $coinsSymbols[$symbol]['value'] = $coinsSymbols[$symbol]['value'] / self::HUNDRED_MILLION;
        }

        return $this->responder->send($coinsSymbols, $platform, $in, $fiat === self::EUR ? self::EURO : self::DOLLAR);
    }
}
