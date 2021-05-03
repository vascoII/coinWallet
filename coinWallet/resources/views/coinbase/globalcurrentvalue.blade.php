@extends('../layouts.app')

@push('head')
    <!-- Styles -->
    <!-- Scripts -->
    <script src="{{ url('/js/highcharts/highcharts.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/exporting.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/export-data.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/accessibility.js') }}" type="text/javascript"></script>
@endpush

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Current Value</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">

            <div class="row-fluid">
                <div class="block">
                    <a href="#page-stats" class="block-heading" data-toggle="collapse">Current Value</a>
                    <div id="page-stats" class="block-body collapse in">
                        <div class="stat-widget-container">
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure>
                        </div>
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
            const chart = Highcharts.chart('container', {
                chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Wallet values over time'
                },
                subtitle: {
                    text: ''
                },
                xAxis: [{
                    categories: [@foreach($chartsData as $chart)
                        '{{ $chart["date"] }}',
                    @endforeach],
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        format: '{value} €',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    title: {
                        text: 'Wallet EUR',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Spend EUR',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    labels: {
                        format: '{value} €',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    opposite: true
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    x: 120,
                    verticalAlign: 'top',
                    y: 100,
                    floating: true,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || // theme
                        'rgba(255,255,255,0.25)'
                },
                series: [{
                    name: 'Spend',
                    type: 'column',
                    yAxis: 1,
                    data: [@foreach($chartsData as $chart)
                        {{ $chart["spend"] }},
                        @endforeach],
                    tooltip: {
                        valueSuffix: ' €'
                    }

                }, {
                    name: 'Wallet',
                    type: 'spline',
                    data: [@foreach($chartsData as $chart)
                        {{ $chart["value"] }},
                        @endforeach],
                    tooltip: {
                        valueSuffix: ' €'
                    }
                }]
            });
        });
    </script>

@endsection
