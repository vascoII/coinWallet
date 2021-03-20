@extends('../layouts.app')

@section('content')
    <div class="header">
        <h1 class="page-title">Transactions</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Quotes</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="btn-toolbar">
                <button class="btn">Import</button>
                <button class="btn">Export</button>
                <div class="btn-group">
                </div>
            </div>
            <div class="well">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Symbol</th>
                            <th>Currency</th>
                            <th>Price</th>
                            <th>Volume 24h</th>
                            <th>Percent Change 1h</th>
                            <th>Percent Change 24h</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotes as $quote)
                        <tr>
                            <td>{{ $quote->getSymbol() }}</td>
                            <td>{{ $quote->getCurrency() }}</td>
                            <td>{{ $quote->getPrice()  . ' €' }}</td>
                            <td>{{ $quote->getVolume24h() }}</td>
                            <td>{{ $quote->getPercentChange1h()}}</td>
                            <td>{{ $quote->getPercentChange24h()}}</td>
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
