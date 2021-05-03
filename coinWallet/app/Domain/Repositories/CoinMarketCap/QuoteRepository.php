<?php


namespace App\Domain\Repositories\CoinMarketCap;

use App\Domain\Collections\CoinMarketCap\QuoteCollection;
use App\Domain\Entities\CoinMarketCap\Quote;

interface QuoteRepository
{
    public function save(Quote $quote): void;
    public function findAll(): ?QuoteCollection;
    public function findLastId(): int;
    public function findLast(int $countCoins): ?QuoteCollection;
    public function findHistoryBySymbol(string $symbol, string $currency = 'EUR'): ?QuoteCollection;
    public function findLastValues(array $amount): array;
    public function findLastBySymbols(array $symbol): ?QuoteCollection;
    public function findFirstBySymbols(array $symbol): ?QuoteCollection;
    public function findFirstValues(string $symbol): Quote;
    public function findValueOverTime(): array;
    public function findValueByCoinOverTime(): array;
    public function findAllBySymbolDate(): array;
    public function findLastPriceBySymbol(string $symbol, string $fiat = 'EUR'): float;
}
