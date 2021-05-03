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
        <li class="active">Charts</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            @for($i = 0; $i < $countCoins; $i++)
                <div class="row-fluid">
                    <div id="coins_{{ $chartsData[$i * 2]['coins'] }}" class="block span6">
                        <a href="#widget{{ $i * 2 }}container" class="block-heading" data-toggle="collapse">Coins {{ $chartsData[$i * 2]['coins'] }}</a>
                        <div id="widget{{ $i * 2 }}container" class="block-body collapse">
                            <figure class="highcharts-figure">
                                <div id="container_coins_{{ $chartsData[$i * 2]['coins'] }}"></div>
                            </figure>
                        </div>
                    </div>
                    @if(isset($chartsData[$i * 2 + 1]['coins']))
                    <div id="coins_{{ $chartsData[$i * 2 + 1]['coins'] }}" class="block span6">
                        <a href="#widget{{ $i * 2 + 1 }}container" class="block-heading" data-toggle="collapse">Coins {{ $chartsData[$i * 2 + 1]['coins'] }}</a>
                        <div id="widget{{ $i * 2 + 1 }}container" class="block-body collapse">
                            <figure class="highcharts-figure">
                                <div id="container_coins_{{ $chartsData[$i * 2 + 1]['coins'] }}"></div>
                            </figure>
                        </div>
                    </div>
                    @endif
                </div>
            @endfor

            <footer>
                <hr />
                <p class="pull-right">Design by <a href="#" target="_blank">Rubus Data</a></p>
                <p>&copy; {{ date('Y') }} <a href="#" target="_blank">Rubus Data</a></p>
            </footer>
        </div>
    </div>

    <script>
        @for($i = 0; $i < $countCoins; $i++)
            document.addEventListener('DOMContentLoaded', function () {
            const chart = Highcharts.chart('container_coins_{{ $chartsData[$i * 2]['coins'] }}', {
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
                    categories: [@foreach($chartsData[$i * 2]['date'] as $date)
                        '{{ $date }}',
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
                    data: [@foreach($chartsData[$i * 2]['spend'] as $spend)
                        {{ $spend }},
                        @endforeach],
                    tooltip: {
                        valueSuffix: ' €'
                    }

                }, {
                    name: 'Wallet',
                    type: 'spline',
                    data: [@foreach($chartsData[$i * 2]['value'] as $value)
                        {{ $value }},
                        @endforeach],
                    tooltip: {
                        valueSuffix: ' €'
                    }
                }]
            });
        });
        @if(isset($chartsData[$i * 2 + 1]['coins']))
            document.addEventListener('DOMContentLoaded', function () {
            const chart = Highcharts.chart('container_coins_{{ $chartsData[$i * 2 + 1]['coins'] }}', {
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
                    categories: [@foreach($chartsData[$i * 2 + 1]['date'] as $date)
                        '{{ $date }}',
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
                    data: [@foreach($chartsData[$i * 2 + 1]['spend'] as $spend)
                        {{ $spend }},
                        @endforeach],
                    tooltip: {
                        valueSuffix: ' €'
                    }

                }, {
                    name: 'Wallet',
                    type: 'spline',
                    data: [@foreach($chartsData[$i * 2 + 1]['value'] as $value)
                        {{ $value }},
                        @endforeach],
                    tooltip: {
                        valueSuffix: ' €'
                    }
                }]
            });
        });
        @endif
        @endfor
    </script>

@endsection
