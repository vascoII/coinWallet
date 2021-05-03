@extends('../layouts.app')

@push('head')
    <!-- Scripts -->
    <script src="{{ url('/js/highcharts/highcharts.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/highstock.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/exporting.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/export-data.js') }}" type="text/javascript"></script>
    <script src="{{ url('/js/highcharts/dark-unica.js') }}" type="text/javascript"></script>
@endpush

@section('content')
    <div class="header">
        <h1 class="page-title">History {{ $symbol }}</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">History</li>
    </ul>

    <div id="container" style="width:100%; height:100%;"></div>

    <script>

    </script>
@endsection
