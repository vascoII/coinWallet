@extends('../layouts.app')

@push('head')
    <!-- Scripts -->
    <script src="{{ url('/js/highcharts/highcharts.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/exporting.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/export-data.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/accessibility.js') }}" type="text/javascript"></script>
@endpush

@section('content')
    <div class="header">
        <h1 class="page-title">{{ ucfirst($platform) }} Current Wallet</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Current Wallet</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="row-fluid">
                <div id="coinsTotal" class="block span6">
                    <a href="#widget_coinsTotal" class="block-heading" data-toggle="collapse">Total</a>
                    <div id="widget_coinsTotal" class="block-body collapse in">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Spend</th>
                                    <th>Transfer</th>
                                    <th>Marge</th>
                                    <th>Current Value</th>
                                    <th>Gain</th>
                                    <th>Losses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $coinsTotal['spend'] . ' €'}}</td>
                                    <td>{{ $coinsTotal['transfer'] . ' €'}}</td>
                                    <td>{{ $coinsTotal['marge'] . ' €'}}</td>
                                    <td>{{ $coinsTotal['value'] . ' €'}}</td>
                                    @if($coinsTotal['value'] > ($coinsTotal['spend'] + $coinsTotal['transfer'] - $coinsTotal['marge']))
                                        <td>{{ $coinsTotal['value'] + $coinsTotal['marge'] - $coinsTotal['spend'] - $coinsTotal['transfer'] . ' €'}}</td>
                                        <td></td>
                                    @else
                                        <td></td>
                                        <td>{{ $coinsTotal['spend'] + $coinsTotal['marge'] + $coinsTotal['transfer'] - $coinsTotal['value'] . ' €'}}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="coins_total" class="block span6">
                    <a href="#widget_coins_total" class="block-heading" data-toggle="collapse">Total Charts</a>
                    <div id="widget_coins_total" class="block-body collapse in">
                        <figure class="highcharts-figure">
                            <div id="container_total"></div>
                        </figure>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div id="coinsSymbols" class="block span6">
                    <a href="#widget_coinsSymbols" class="block-heading" data-toggle="collapse">Total Coins</a>
                    <div id="widget_coinsSymbols" class="block-body collapse in">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Symbol</th>
                                <th>Spend</th>
                                <th>Transfer</th>
                                <th>Marge</th>
                                <th>Current Value</th>
                                <th>Gain</th>
                                <th>Losses</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coinsSymbols as $symbol => $value)
                                <tr>
                                    <td>{{ $symbol }}</td>
                                    <td>{{ $value['spend'] . ' €'}}</td>
                                    <td>{{ $value['transfer'] . ' €'}}</td>
                                    <td>{{ $value['marge'] . ' €'}}</td>
                                    <td>{{ $value['value'] . ' €'}}</td>
                                    @if($value['value'] > ($value['spend']))
                                        <td>{{ $value['value'] - $value['spend'] - $value['transfer'] + $value['marge'] . ' €'}}</td>
                                        <td></td>
                                    @else
                                        <td></td>
                                        <td>{{ $value['value'] - $value['spend'] - $value['transfer'] + $value['marge'] . ' €'}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="coins_symbol" class="block span6"  >
                    <a href="#widget_coins_symbols" class="block-heading" data-toggle="collapse">Total Coins Charts</a>
                    <div id="widget_coins_symbols" class="block-body collapse in">
                        <figure class="highcharts-figure">
                            <div id="container_total_coins"></div>
                        </figure>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div id="coinsWallet" class="block span6">
                    <a href="#widget_coinsWallet" class="block-heading" data-toggle="collapse">Details Coins</a>
                    <div id="widget_coinsWallet" class="block-body collapse in">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Symbol</th>
                                <th>Date</th>
                                <th>Spend</th>
                                <th>Transfer</th>
                                <th>Marge</th>
                                <th>Current Value</th>
                                <th>Gain</th>
                                <th>Losses</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coinsWallet as $symbol => $coins)
                                @foreach($coins as $value)
                                    <tr>
                                        <td>{{ $symbol }}</td>
                                        <td>{{ $value['date'] }}</td>
                                        <td>{{ $value['spend'] . ' €'}}</td>
                                        <td>{{ $value['transfer'] . ' €'}}</td>
                                        <td>{{ $value['marge'] . ' €'}}</td>
                                        <td>{{ $value['value'] . ' €'}}</td>
                                        @if($value['value'] > ($value['spend'] + $value['transfer'] - $value['marge']))
                                            <td>{{ $value['value'] - $value['spend'] - $value['transfer'] + $value['marge'] . ' €'}}</td>
                                            <td></td>
                                        @else
                                            <td></td>
                                            <td>{{ $value['spend'] + $value['transfer'] - $value['value'] - $value['marge'] . ' €'}}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="coins_wallet" class="block span6">
                    <a href="#widget_coins_wallet" class="block-heading" data-toggle="collapse">Details Coins Charts</a>
                    <div id="widget_coins_wallet" class="block-body collapse in">
                        <figure class="highcharts-figure">
                            <div id="container_coins_wallet"></div>
                        </figure>
                    </div>
                </div>
            </div>

            <footer>
                <hr />
                <p class="pull-right">Design by <a href="#" target="_blank">Rubus Data</a></p>
                <p>&copy; {{ date('Y') }} <a href="#" target="_blank">Rubus Data</a></p>
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chart = Highcharts.chart('container_total', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total spend/transfer, gain and losses'
                },
                xAxis: {
                    categories: ['Total']
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Spend + Transfer - Marge',
                    data: [{{ $coinsTotal['spend'] + $coinsTotal['transfer'] - $coinsTotal['marge'] }}]
                }, {
                    name: 'Gain',
                    data: [@if($coinsTotal['value'] > ($coinsTotal['spend'] + $coinsTotal['transfer'] - $coinsTotal['marge']))
                        {{ $coinsTotal['value'] + $coinsTotal['marge'] - $coinsTotal['spend'] - $coinsTotal['transfer'] }}
                        @else
                        0
                        @endif]
                }, {
                    name: 'Losses',
                    data: [@if($coinsTotal['value'] > ($coinsTotal['spend'] + $coinsTotal['transfer']))
                        0
                        @else
                        {{ $coinsTotal['value'] - $coinsTotal['spend'] - $coinsTotal['transfer'] }}
                        @endif]
                }]
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const chart = Highcharts.chart('container_total_coins', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total spend/transfer - marge, gain and losses by Coins'
                },
                xAxis: {
                    categories: [@foreach($coinsSymbols as $symbol => $value)
                        '{{ $symbol }}',
                    @endforeach]
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Spend + Transfer - Marge',
                    data: [@foreach($coinsSymbols as $symbol => $value)
                        {{ $value['spend'] + $value['transfer'] - $value['marge'] }},
                    @endforeach]
                }, {
                    name: 'Gain',
                    data: [@foreach($coinsSymbols as $symbol => $value)
                        @if($value['value'] > ($value['spend'] + $value['transfer'] - $value['marge']))
                        {{ $value['value'] - $value['spend'] - $value['transfer'] + $value['marge'] }},
                        @else
                        0,
                        @endif
                    @endforeach]
                }, {
                    name: 'Losses',
                    data: [@foreach($coinsSymbols as $symbol => $value)
                        @if($value['value'] < ($value['spend'] + $value['transfer'] - $value['marge']))
                        {{ $value['value'] - $value['spend'] - $value['transfer']  + $value['marge'] }},
                        @else
                        0,
                        @endif
                    @endforeach]
                }]
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const chart = Highcharts.chart('container_coins_wallet', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total spend/transfer, gain and losses by Coins and Buy Date'
                },
                xAxis: {
                    categories: [@foreach($coinsWallet as $symbol => $coins)
                        @foreach($coins as $value)
                        '{{ $symbol . ' / ' . $value['date'] }}',
                        @endforeach
                    @endforeach]
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Spend + Transfer - Marge',
                    data: [@foreach($coinsWallet as $symbol => $coins)
                        @foreach($coins as $value)
                        {{ $value['spend'] + $value['transfer'] - $value['marge'] }},
                        @endforeach
                    @endforeach]
                }, {
                    name: 'Gain',
                    data: [@foreach($coinsWallet as $symbol => $coins)
                        @foreach($coins as $value)
                            @if($value['value'] > ($value['spend'] + $value['transfer'] - $value['marge']))
                            {{ $value['value'] - $value['spend'] - $value['transfer'] + $value['marge'] }},
                            @else
                                0,
                            @endif
                        @endforeach
                    @endforeach]
                }, {
                    name: 'Losses',
                    data: [@foreach($coinsWallet as $symbol => $coins)
                        @foreach($coins as $value)
                            @if($value['value'] < ($value['spend'] + $value['transfer'] - $value['marge']))
                            {{ $value['value'] - $value['spend'] - $value['transfer'] + $value['marge'] }},
                            @else
                                0,
                            @endif
                        @endforeach
                    @endforeach]
                }]
            });
        });
    </script>

@endsection
