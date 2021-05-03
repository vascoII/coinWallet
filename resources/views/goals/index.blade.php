@extends('../layouts.app')

@section('content')
    <div class="header">
        <h1 class="page-title">List Goals</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Goals</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="well">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Symbol</th>
                        <th>Amount</th>
                        <th>Buy/Earn Value</th>
                        <th>Actual Value</th>
                        <th>Percent</th>
                        <th>Amount to Sell</th>
                        <th>Gain</th>
                        <th>Amount after Sell</th>
                        <th>Value after Sell</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($goalCollection->all() as $goal)
                        <tr>
                            <td>{{ $goal->getSymbol() }}</td>
                            <td>{{ $goal->getAmount() }}</td>
                            <td>{{ number_format($goal->getFirstVale(), 2, ',', ' ') . ' €'}}</td>
                            <td>{{ number_format($goal->getLastValue(), 2, ',', ' ') . ' €' }}</td>
                            <td>{{ $goal->getPercent() }}</td>
                            <td>{{ $goal->getAmountSell() }}</td>
                            <td>@if(!is_null($goal->getGain())) {{ number_format($goal->getGain(), 2, ',', ' ') . ' €' }} @endif</td>
                            <td>{{ $goal->getAmountPostSell() }}</td>
                            <td>@if(!is_null($goal->getGain())) {{ number_format($goal->getValuePostSell(), 2, ',', ' ') .' €' }} @endif</td>
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
