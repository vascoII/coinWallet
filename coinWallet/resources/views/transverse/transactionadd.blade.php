@extends('../layouts.app')

@section('content')
    <div class="header">
        <h1 class="page-title">Transactions</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Add Transaction</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="row-fluid">
                <div id="buy" class="block span4">
                    <a href="#widget1container_01" class="block-heading" data-toggle="collapse">Transaction - Buy</a>
                    <div id="widget1container_01" class="block-body collapse">
                        <figure class="highcharts-figure">
                            <div id="container_buy">
                                <form method="POST" action="{{ url($platform . '/transactions/add') }}">
                                    @csrf
                                    <div class="form-group" hidden>
                                        <label>id</label>
                                        <input type="text" class="form-control" name="id" id="id" value="{{ $id }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Symbol</label>
                                        <input type="text" class="form-control" name="symbol" id="symbol" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="type" id="type" value="buy" required>
                                    </div>
                                    <div class="form-group">
                                        <label>ReferenceCode</label>
                                        <input type="text" class="form-control" name="reference_code" id="referenceCode" required>
                                    </div>
                                    <div class="form-group">
                                        <label>PaymentMethod</label>
                                        <input type="text" class="form-control" name="payment_method" id="paymentMethod" required>
                                    </div>
                                    <div class="form-group">
                                        <label>DateHour</label>
                                        <input type="text" class="form-control" name="date_hour" id="dateHour" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" step="0.00000001" class="form-control" name="amount" id="amount" required>
                                    </div>
                                    <div class="form-group">
                                        <label>ExchangeRate</label>
                                        <input type="number" step="0.00000001" class="form-control" name="exchange_rate" id="exchangeRate" required>
                                    </div>
                                    <div class="form-group">
                                        <label>SubTotal</label>
                                        <input type="number" step="0.00000001" class="form-control" name="sub_total" id="subTotal" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Fees</label>
                                        <input type="number" step="0.00000001" class="form-control" name="fees" id="fees" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Platform</label>
                                        <input type="text" class="form-control" name="platform" id="platform" value="{{ $platform }}" required>
                                    </div>
                                    <input type="submit" name="send" value="Add" class="btn btn-dark btn-block">
                                </form>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div id="sell" class="block span4">
                    <a href="#widget1container_02" class="block-heading" data-toggle="collapse">Transaction - Sell</a>
                    <div id="widget1container_02" class="block-body collapse">
                        <figure class="highcharts-figure">
                            <div id="container_sell">
                                <form method="POST" action="{{ url($platform . '/transactions/add') }}">
                                    @csrf
                                    <div class="form-group" hidden>
                                        <label>id</label>
                                        <input type="text" class="form-control" name="id" id="id" value="{{ $id }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Symbol</label>
                                        <select name="symbol" id="symbol" required>
                                            <option value="">--Symbol--</option>
                                            @foreach($coinSymbolList as $coin)
                                                <option value="{{ $coin }}">{{ ucfirst($coin) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Stable Coin</label>
                                        <input type="text" class="form-control" name="stableCoin" id="type" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="type" id="type" value="sell" required>
                                    </div>
                                    <div class="form-group">
                                        <label>DateHour</label>
                                        <input type="text" class="form-control" name="date_hour" id="dateHour" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" step="0.00000001" class="form-control" name="amount" id="amount" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="number" step="0.00000001" class="form-control" name="total" id="total" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Platform</label>
                                        <input type="text" class="form-control" name="platform" id="platform" value="{{ $platform }}" required>
                                    </div>
                                    <input type="submit" name="send" value="Add" class="btn btn-dark btn-block">
                                </form>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div id="earn" class="block span4">
                    <a href="#widget1container_03" class="block-heading" data-toggle="collapse">Transaction - Earn</a>
                    <div id="widget1container_03" class="block-body collapse">
                        <figure class="highcharts-figure">
                            <div id="container_earn">
                                <form method="POST" action="{{ url($platform . '/transactions/add') }}">
                                    @csrf
                                    <div class="form-group" hidden>
                                        <label>id</label>
                                        <input type="text" class="form-control" name="id" id="id" value="{{ $id }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Symbol</label>
                                        <input type="text" class="form-control" name="symbol" id="symbol" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="type" id="type" value="earn" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>ReferenceCode</label>
                                        <input type="text" class="form-control" name="reference_code" id="referenceCode" value="{{ $defaultGenerateCode }}">
                                    </div>
                                    <div class="form-group">
                                        <label>DateHour</label>
                                        <input type="text" class="form-control" name="date_hour" id="dateHour" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" step="0.00000001" class="form-control" name="amount" id="amount" required>
                                    </div>
                                    <div class="form-group">
                                        <label>ExchangeRate</label>
                                        <input type="number" step="0.00000001" class="form-control" name="exchange_rate" id="exchangeRate" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="number" step="0.00000001" class="form-control" name="total" id="total" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Platform</label>
                                        <input type="text" class="form-control" name="platform" id="platform" value="{{ $platform }}" required>
                                    </div>
                                    <input type="submit" name="send" value="Add" class="btn btn-dark btn-block">
                                </form>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div id="exchange" class="block span4">
                    <a href="#widget1container_04" class="block-heading" data-toggle="collapse">Transaction - Exchange</a>
                    <div id="widget1container_04" class="block-body collapse">
                        <figure class="highcharts-figure">
                            <div id="container_exchange">
                                <form method="POST" action="{{ url($platform . '/transactions/add') }}">
                                    @csrf
                                    <div class="form-group" hidden>
                                        <label>id</label>
                                        <input type="text" class="form-control" name="id" id="id" value="{{ $id }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Symbol</label>
                                        <input type="text" class="form-control" name="symbol" id="symbol" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="type" id="type" value="exchange">
                                    </div>
                                    <div class="form-group">
                                        <label>ReferenceCode</label>
                                        <input type="text" class="form-control" name="reference_code" id="referenceCode" required>
                                    </div>
                                    <div class="form-group">
                                        <label>PaymentMethod</label>
                                        <select name="payment_method" id="payment_method" required>
                                            <option value="">--PaymentMethod--</option>
                                            @foreach($coinSymbolList as $coin)
                                                <option value="{{ $coin }}">{{ ucfirst($coin) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>DateHour</label>
                                        <input type="text" class="form-control" name="date_hour" id="dateHour" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" step="0.00000001" class="form-control" name="amount" id="amount" required>
                                    </div>
                                    <div class="form-group">
                                        <label>ExchangeRate</label>
                                        <input type="number" step="0.00000001" class="form-control" name="exchange_rate" id="exchangeRate" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Platform</label>
                                        <input type="text" class="form-control" name="platform" id="platform" value="{{ $platform }}" required>
                                    </div>
                                    <input type="submit" name="send" value="Add" class="btn btn-dark btn-block">
                                </form>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div id="send" class="block span4">
                    <a href="#widget1container_05" class="block-heading" data-toggle="collapse">Transaction - Send</a>
                    <div id="widget1container_05" class="block-body collapse">
                        <figure class="highcharts-figure">
                            <div id="container_transfer">
                                <form method="POST" action="{{ url($platform . '/transactions/add') }}">
                                    @csrf
                                    <div class="form-group" hidden>
                                        <label>id</label>
                                        <input type="text" class="form-control" name="id" id="id" value="{{ $id }}" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="type" id="type" value="transfert" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Symbol</label>
                                        <select name="symbol" id="symbol" required>
                                            <option value="">--Symbol--</option>
                                            @foreach($coinSymbolList as $coin)
                                                <option value="{{ $coin }}">{{ ucfirst($coin) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>ReferenceCode</label>
                                        <input type="text" class="form-control" name="reference_code" id="referenceCode" value="{{ $defaultGenerateCode }}">
                                    </div>
                                    <div class="form-group">
                                        <label>DateHour</label>
                                        <input type="text" class="form-control" name="date_hour" id="dateHour" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount Send</label>
                                        <input type="number" step="0.00000001" class="form-control" name="amountSend" id="amountSend" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount Received</label>
                                        <input type="number" step="0.00000001" class="form-control" name="amountReceived" id="amountReceived" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Fees</label>
                                        <input type="number" step="0.00000001" class="form-control" name="fees" id="fees" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="number" step="0.00000001" class="form-control" name="total" id="total" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>PlatformFrom</label>
                                        <input type="text" class="form-control" name="platformFrom" id="platformFrom" value="{{ $platform }}">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>PlatformTo</label>
                                        <input type="text" class="form-control" name="platformTo" id="platformTo" value="@if($platform === 'binance') coinbase @else binance @endif">
                                    </div>
                                    <input type="submit" name="send" value="Add" class="btn btn-dark btn-block">
                                </form>
                            </div>
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
@endsection
