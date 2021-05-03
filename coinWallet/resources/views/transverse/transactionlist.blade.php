@extends('../layouts.app')

@section('content')
    <div class="header">
        <h1 class="page-title">Transactions</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Transactions</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="btn-toolbar">
                <button class="btn btn-primary"><a href="{{ url($platform .'/transactions/add') }}"><i class="icon-plus"></i>New Transaction</a></button>
                @foreach ($types as $type)
                    <button class="btn" style="float: right;">{{ ucfirst($type) }}</button>
                @endforeach
                <div class="btn-group">
                </div>
            </div>
            <div class="well">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Symbol</th>
                            <th>Type</th>
                            <th>Code reference</th>
                            <th>Payment method</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Sub total</th>
                            <th>Fees</th>
                            <th>Total</th>
                            <th>Exchange Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            @if(in_array($transaction->getType(), ['buy', 'earn']))
                                <td>{{ $transaction->getId() }}</td>
                                <td>{{ $transaction->getSymbol() }}</td>
                                <td>{{ $transaction->getType() }}</td>
                                <td>{{ $transaction->getReferenceCode() }}</td>
                                <td>{{ $transaction->getPaymentMethod() }}</td>
                                <td>{{ $transaction->getDateHour() }}</td>
                                <td>{{ $transaction->getAmount() / 100000000 }} </td>
                                <td>{{ $transaction->getSubTotal() / 100000000  . ' €' }}</td>
                                <td>{{ $transaction->getFees() / 100000000  . ' €' }}</td>
                                <td>{{ $transaction->getTotal() / 100000000 . ' €'  }}</td>
                                <td>{{ $transaction->getExchangeRate() / 100000000  . ' € / ' .  $transaction->getSymbol() }}</td>
                            @elseif(in_array($transaction->getType(), ['exchange']))
                                <td>{{ $transaction->getId() }}</td>
                                <td>{{ $transaction->getSymbol() }}</td>
                                <td>{{ $transaction->getType() }}</td>
                                <td>{{ $transaction->getReferenceCode() }}</td>
                                <td>{{ $transaction->getPaymentMethod() }}</td>
                                <td>{{ $transaction->getDateHour() }}</td>
                                <td>{{ $transaction->getAmount() / 100000000 }} </td>
                                <td>{{ $transaction->getSubTotal() / 100000000  . ' €' }}</td>
                                <td>{{ $transaction->getFees() / 100000000  . ' €' }}</td>
                                <td>{{ $transaction->getTotal() / 100000000 . ' €'  }}</td>
                                <td>{{ $transaction->getExchangeRate() / 100000000 }}</td>
                            @endif
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

            <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Delete Confirmation</h3>
                </div>
                <div class="modal-body">
                    <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button class="btn btn-danger" data-dismiss="modal">Delete</button>
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
