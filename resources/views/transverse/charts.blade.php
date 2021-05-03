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
    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Dashboard</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="row-fluid">
                <div id="coins" class="block span6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Symbol</th>
                            <th>Amount</th>
                            <th>Spend</th>
                            <th>Wallet Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coinsWallet as $key => $coin)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ round($coin['amount'] / 100000000, 2) }}</td>
                                <td>{{ round($coin['amount']  * $coin['buyAt'] / 100000000, 2) . ' €'}}</td>
                                <td>{{ round($coin['amount']  * $coin['current'] / 100000000, 2) . ' €'}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="coins_donut" class="block span6">
                    <a href="#widget1container" class="block-heading" data-toggle="collapse">Gain / Losses</a>
                    <div id="widget1container" class="block-body collapse in">
                        <figure class="highcharts-figure">
                            <div id="container_charts"></div>
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
            const chart = Highcharts.chart('container_charts', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45
                    }
                },
                title: {
                    text: 'Wallet Value'
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
                    name: 'Values',
                    data: [
                        @foreach($values as $key => $value)
                            ['{{ $key }}', {{ $value }}],
                        @endforeach
                    ]
                }]
            });
        });
    </script>

@endsection
