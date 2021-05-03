@extends('../layouts.app')

@push('head')
    <!-- Scripts -->
    <script src="{{ url('/js/highcharts/highcharts.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/highcharts-3d.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/exporting.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/export-data.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/accessibility.js') }}" type="text/javascript"></script>
@endpush

@section('content')
    <div class="header">
        <h1 class="page-title">Dashboard</h1>
    </div>

    <ul class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
            <li class="active">Dashboard</li>
        </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="row-fluid">
                @if(!is_null($alertInfo))
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Just a quick note:</strong>Time to sell
                    @foreach($alertInfo->all() as $info)
                        {{ $info->getAmount() }} of {{ $info->getCoinSymbol() }}
                    @endforeach
                </div>
                @endif

                <div class="block">
                    <a href="#page-stats" class="block-heading" data-toggle="collapse">Latest Stats</a>
                    <div id="page-stats" class="block-body collapse in">

                        <div class="stat-widget-container">
                            <div class="stat-widget">
                                <div class="stat-button">
                                    <p class="title">{{ '€ ' . $stats->getBuy() }}</p>
                                    <p class="detail">Buying price</p>
                                </div>
                            </div>

                            <div class="stat-widget">
                                <div class="stat-button">
                                    <p class="title">{{ '€ ' . $stats->getFee() }}</p>
                                    <p class="detail">Fees</p>
                                </div>
                            </div>

                            <div class="stat-widget">
                                <div class="stat-button">
                                    <p class="title">{{ '€ ' . $stats->getEarn() }}</p>
                                    <p class="detail">Earn</p>
                                </div>
                            </div>

                            <div class="stat-widget">
                                <div class="stat-button">
                                    <p class="title">{{ '€ ' . $stats->getSell() }}</p>
                                    <p class="detail">Sell</p>
                                </div>
                            </div>

                            <div class="stat-widget">
                                <div class="stat-button">
                                    @if(abs($stats->getGain()) > abs($stats->getLosses()))
                                        <p class="title_green">
                                    @else
                                        <p class="title">
                                    @endif
                                        {{ '€ ' . $stats->getGain() }}
                                    </p>
                                    @if(abs($stats->getGain()) > abs($stats->getLosses()))
                                        <p class="detail_green">
                                    @else
                                        <p class="detail">
                                    @endif
                                        Gain
                                    </p>
                                </div>
                            </div>

                            <div class="stat-widget">
                                <div class="stat-button">
                                    @if(abs($stats->getGain()) < abs($stats->getLosses()))
                                        <p class="title_red">
                                    @else
                                        <p class="title">
                                    @endif
                                        {{ '€ ' . $stats->getLosses()   }}
                                    </p>
                                    @if(abs($stats->getGain()) < abs($stats->getLosses()))
                                        <p class="detail_red">
                                    @else
                                        <p class="detail">
                                    @endif
                                        Losses
                                    </p>
                                </div>
                            </div>

                            <div class="stat-widget">
                                <div class="stat-button">
                                    @if(abs($stats->getBuy()) > abs($stats->getCurrentValue()))
                                        <p class="title_red">
                                    @elseif(abs($stats->getBuy()) < abs($stats->getCurrentValue()))
                                        <p class="title_green">
                                    @else
                                        <p class="title">
                                    @endif
                                        {{ '€ ' . $stats->getCurrentValue() }}
                                    </p>
                                    @if(abs($stats->getBuy()) > abs($stats->getCurrentValue()))
                                        <p class="detail_red">
                                    @elseif(abs($stats->getBuy()) < abs($stats->getCurrentValue()))
                                        <p class="detail_green">
                                    @else
                                        <p class="detail">@endif
                                        Current Value
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div id="coins" class="block span6">
                    <a href="#tablewidget" class="block-heading" data-toggle="collapse">
                        Coins<span class="label label-warning">{{ count($coins) }}</span>
                    </a>
                    <div id="tablewidget" class="block-body collapse in">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Symbol</th>
                                <th>Slug</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coins as $coin)
                                <tr>
                                    <td>{{ $coin->getName() }}</td>
                                    <td>{{ $coin->getSymbol() }}</td>
                                    <td>{{ $coin->getSlug() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <p><a href="{{ url('/coins') }}">More...</a></p>
                    </div>
                </div>
                <div id="coins_donut" class="block span6">
                    <a href="#widget1container" class="block-heading" data-toggle="collapse">Coins Percent</a>
                    <div id="widget1container" class="block-body collapse in">
                        <figure class="highcharts-figure">
                            <div id="container_coins"></div>
                        </figure>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div id="quotes" class="block span6">
                    <div class="block-heading">
                        <span class="block-icon pull-right">
                            <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i class="icon-refresh"></i></a>
                        </span>

                        <a href="#widget2container" data-toggle="collapse">Last Quotes History</a>
                    </div>
                    <div id="tablewidget" class="block-body collapse in">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Symbol</th>
                                <th>Price</th>
                                <th>Volume</th>
                                <th>Percent change 24h</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quotes as $quote)
                                <tr>
                                    <td>{{ $quote->getSymbol() }}</td>
                                    <td>{{ $quote->getPrice() . ' €'}}</td>
                                    <td>{{ $quote->getVolume24h()  }}</td>
                                    <td>{{ $quote->getPercentChange24h()  }}</td>
                                    <td>{{ date('Y-m-d', strtotime($quote->getLastUpdated())) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <p><a href="{{ url('/quotes') }}">More...</a></p>
                    </div>
                </div>
                <div id="quotes_donut" class="block span6">
                    <a href="#widget1container" class="block-heading" data-toggle="collapse">Coins Values</a>
                    <div id="widget1container" class="block-body collapse in">
                        <figure class="highcharts-figure">
                            <div id="container_quotes"></div>
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
            const chart = Highcharts.chart('container_coins', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45
                    }
                },
                title: {
                    text: 'Coins Percentage in Wallet'
                },
                subtitle: {
                    text: ''
                },
                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                    name: 'Percentage',
                    data: [
                        @foreach($percentCoins as $percent)
                            ['{{ $percent->getName() }}', {{ $percent->getPercent() }}],
                        @endforeach
                    ]
                }]
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const chart = Highcharts.chart('container_quotes', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45
                    }
                },
                title: {
                    text: 'Coins Values in Wallet'
                },
                subtitle: {
                    text: "{{ '€ ' . $currentValue }}"
                },
                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                    name: 'Values',
                    data: [
                        @foreach($valueCoins as $value)
                            ['{{ $value->getName() }}', {{ $value->getValue() }}],
                        @endforeach
                    ]
                }]
            });
        });
    </script>

@endsection
