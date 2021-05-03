<?php

namespace App\Http\Controllers\Actions\Transverse;


use App\Domain\Repositories\CoinMarketCap\QuoteRepository;
use App\Domain\Repositories\Transverse\TransactionRepository;
use App\Http\Responders\Transverse\SellsResponder;
use Illuminate\Http\Request;

class SellsAction extends TransverseAction
{
    public TransactionRepository $transactions;
    public QuoteRepository $quoteRepository;
    public SellsResponder $responder;

    public function __construct(
        TransactionRepository $transactions,
        QuoteRepository $quoteRepository,
        SellsResponder $responder
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->transactions = $transactions;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        $totalSpend = $totalNow = $totalLosses = 0;
        [$platform, $in] = $this->init($request);
        $coinsWallet = $coinsSymbols = [];

        $transactionCollection = $this->transactions->findPartial($platform);
        /**foreach ($transactionCollection->all() as $coin) {
            $coinsWallet[$coin->getSymbol()] = ['amount' => 0];
        }
        foreach ($transactionCollection->all() as $coin) {
            $coinsWallet[$coin->getSymbol()]['amount'] += $coin->getAmount();
            if ($coin->getPaymentMethod() === 'EUR') {
                $totalSpend += $coin->getTotal() / self::HUNDRED_MILLION;
            }
        }
        foreach ($coinsWallet as $key => $coin) {
            if ($coin['amount'] === 0) {
                unset($coinsWallet[$key]);
            }
        }
        foreach ($coinsWallet as $key => $coin) {
            $coinsSymbols[] = $key;
        }

        $lastQuoteCollection = $this->quoteRepository->findLastBySymbols($coinsSymbols);

        foreach ($lastQuoteCollection->all() as $lastQuote) {
            echo '<pre>'; var_dump(
                $lastQuote->getSymbol() === 'CELO' ? 'CGLD' : $lastQuote->getSymbol(),
                $coinsWallet[$lastQuote->getSymbol() === 'CELO' ? 'CGLD' : $lastQuote->getSymbol()]['amount'],
                $lastQuote->getSymbol(),
                $lastQuote->getPrice()
            ); echo '</pre>';
            $totalNow += $coinsWallet[$lastQuote->getSymbol() === 'CELO' ? 'CGLD' : $lastQuote->getSymbol()]['amount']
                * $lastQuote->getPrice() / self::HUNDRED_MILLION;
        }
        if ($totalGain < $totalSpend) {
            $totalSpend = round($totalSpend / self::HUNDRED_MILLION, 2);
            $totalLosses = round($totalSpend - $totalGain, 2);
            $totalGain = round(0, 2);
        } else {
            $totalSpend = round($totalSpend / self::HUNDRED_MILLION, 2);
            $totalLosses = round($totalLosses, 2);
            $totalGain = round($totalGain - $totalSpend, 2);
        }
*/
        return $this->responder->send($platform);
    }
}
