@extends('../layouts.app')

@section('content')
    <div class="header">
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
                        <th>Buy At</th>
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
                            <td>{{ $coin['buy_rate'] . ' €'}}</td>
                            <td>{{ $coin['current_rate'] . ' €' }}</td>
                            <td>@if($coin['current_rate'] > $coin['buy_rate'] ){{ ($coin['current_rate'] - $coin['buy_rate']) * $coin['amount']  . ' €' }} @endif</td>
                            <td>@if($coin['current_rate'] > $coin['buy_rate'] )
                                    {{ round( $coin['current_rate'] * 100 / $coin['buy_rate'] - 100, 2) . ' %'  }}
                                @endif</td>
                            <td>@if($coin['current_rate'] < $coin['buy_rate'] ){{ ($coin['buy_rate'] - $coin['current_rate']) * $coin['amount']  . ' €' }} @endif</td>
                            <td>@if($coin['current_rate'] < $coin['buy_rate'] )
                                    {{ round($coin['current_rate'] * 100 / $coin['buy_rate'] - 100, 2) . ' %' }}
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
