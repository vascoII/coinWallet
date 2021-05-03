@extends('../layouts.app')

@section('content')
    <div class="header">
        <h1 class="page-title">Quotes</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Quotes</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="btn-toolbar">
                <button class="btn">USD $</button>
                <button class="btn">EUR €</button>
                <div class="btn-group">
                </div>
            </div>
            <div class="well">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>24h %</th>
                            <th>7d %</th>
                            <th>Market Cap</th>
                            <th>Volume(24h)</th>
                            <th>Circulating Supply</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotes as $quote)
                        <tr>
                            <td><a href="{{ url('quote/' . $quote->getSymbol()) }}">{{ $quote->getSymbol() }}</a></td>
                            <td>{{ number_format($quote->getPrice(), 2, ',', ' ') }} @if($quote->getCurrency() === 'USD') {{ ' $' }} @else {{ ' €' }} @endif</td>
                            <td>{{ $quote->getPercentChange24h()}}</td>
                            <td>{{ $quote->getPercentChange7d()}}</td>
                            <td>{{ number_format($quote->getMarketCap(), 2, ',', ' ') }}</td>
                            <td>{{ number_format($quote->getVolume24h(), 2, ',', ' ') }}</td>
                            <td>{{ number_format($quote->getCirculatingSupply(), 2, ',', ' ') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <ul>
                    <li><a href="#">Prev</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>

            <footer>
                <hr />
                <p class="pull-right">Design by <a href="#" target="_blank">Rubus Data</a></p>
                <p>&copy; {{ date('Y') }} <a href="#" target="_blank">Rubus Data</a></p>
            </footer>
        </div>
    </div>
@endsection
