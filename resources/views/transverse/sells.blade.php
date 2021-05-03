@extends('../layouts.app')

@section('content')
    <div class="header">
        <h1 class="page-title">{{ ucfirst($platform) }} Sells</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Sells</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="row-fluid">
                <div id="coinsTotal" class="block span6">
                    <a href="#widget_coinsSells" class="block-heading" data-toggle="collapse">Sells</a>
                    <div id="widget_coinsSells" class="block-body collapse in">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Symbol</th>
                                    <th>Amount</th>
                                    <th>Sells Price</th>
                                    <th>Gain</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div id="coinsTotal" class="block span6">
                    <a href="#widget_coinsBuy" class="block-heading" data-toggle="collapse">Buy</a>
                    <div id="widget_coinsBuy" class="block-body collapse in">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Symbol</th>
                                <th>Sells Price</th>
                                <th>Current Price</th>
                                <th>Buying</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
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

@endsection
