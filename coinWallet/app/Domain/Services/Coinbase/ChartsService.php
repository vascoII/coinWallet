<?php


namespace App\Domain\Services\Coinbase;

use App\Domain\Repositories\Transverse\CoinRepository;

class ChartsService
{
    public CoinRepository $coinRepository;

    public function __construct(CoinRepository $coinRepository) {
        $this->coinRepository = $coinRepository;
    }

    public array $rgb = [
        [
            'lineColor' => 'rgb(180,90,50)',
            'color' => 'rgb(200,110,50)',
            'fillColor' => 'rgb(200,110,50)'
        ], [
            'lineColor' => 'rgb(120,160,180)',
            'color' => 'rgb(140,180,200)',
            'fillColor' => 'rgb(140,180,200)'
        ], [
            'lineColor' => 'rgb(200, 190, 140)',
            'color' => 'rgb(200, 190, 140)',
            'fillColor' => 'rgb(230, 220, 180)'
        ],
    ];

    public function __invoke(array $datas): array
    {
        $res = [];
        $i = 0;
        foreach ($datas as $key => $data) {
            $res[$key] = [
                'xAxis' => $i,
                'lineColor' => $this->rgb[$i % 3]['lineColor'],
                'color' => $this->rgb[$i % 3]['color'],
                'fillColor' => $this->rgb[$i % 3]['fillColor'],
                'name' => $this->coinRepository->findOneBySymbol($key)->getName(),
                'data' => $data
            ];
            $i++;
        }
        return $res;
    }

}
