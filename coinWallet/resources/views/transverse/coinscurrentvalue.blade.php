@extends('../layouts.app')

@section('content')
    <div class="header">
        <div class="stats">
            <p class="stat"><span class="number">€</span><a href="{{ url( $platform . '/coinscurrentvalue?fiat=EUR') }}">EUR</a></p>
            <p class="stat"><span class="number">$</span><a href="{{ url( $platform . '/coinscurrentvalue?fiat=USD') }}">USD</a></p>
        </div>

        <h1 class="page-title">List Coins</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Current Values</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="well">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Symbol</th>
                        <th>Amount</th>
                        <th>Current Value</th>
                        <th>Gain</th>
                        <th>Percent Gain</th>
                        <th>Losses</th>
                        <th>Percent Losses</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($valuesData as $key => $coin)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $coin['amount'] }}</td>
                            <td>{{ $coin['current_rate'] . $fiat }}</td>
                            <td>@if($coin['value'] > ($coin['spend'] + $coin['transfer'] - $coin['marge']))
                                    {{ round($coin['value'] - $coin['spend'] - $coin['transfer'] + $coin['marge'], 2) . $fiat }}
                                @endif</td>
                            <td>@if($coin['value'] > ($coin['spend'] + $coin['transfer'] - $coin['marge']))
                                    {{ round( $coin['value'] * 100 / ($coin['spend'] + $coin['transfer'] - $coin['marge']) - 100, 2) . ' %'  }}
                                @endif</td>
                            <td>@if($coin['value'] < ($coin['spend'] + $coin['transfer'] - $coin['marge']))
                                    {{ round(($coin['spend'] + $coin['transfer'] - $coin['marge']) - $coin['value'], 2) . $fiat}}
                                @endif</td>
                            <td>@if($coin['value'] < ($coin['spend'] + $coin['transfer'] - $coin['marge']))
                                    {{ round( 100 - $coin['value'] * 100 / ($coin['spend'] + $coin['transfer'] - $coin['marge']), 2) . ' %'  }}
                                @endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <footer>
                <hr />
                <p class="pull-right">Design by <a href="#" target="_blank">Rubus Data</a></p>
                <p>&copy; {{ date('Y') }} <a href="#" target="_blank">Rubus Data</a></p>
            </footer>
        </div>
    </div>
@endsection
