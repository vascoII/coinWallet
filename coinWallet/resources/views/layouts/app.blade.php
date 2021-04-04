<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <title>Coin Wallet</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="stylesheet" type="text/css" href="{{ url('/lib/bootstrap/css/bootstrap.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ url('/css/theme.css') }}" />
    <link rel="stylesheet" href="{{ url('/lib/font-awesome/css/font-awesome.css') }}" />

    <script src="{{ url('/lib/jquery-1.7.2.min.js') }}" type="text/javascript"></script>

    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @stack('head')
    </head>

    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
    <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
    <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
    <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!-->
    <body class="">
    <!--<![endif]-->

        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav pull-right">

                    <li><a href="#" class="hidden-phone visible-tablet visible-desktop" role="button">Settings</a></li>
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> Fabrice Da Silva
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#">My Account</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" class="visible-phone" href="#">Settings</a></li>
                            <li class="divider visible-phone"></li>
                            <li><a tabindex="-1" href="{{ url('/login') }}">Logout</a></li>
                        </ul>
                    </li>

                </ul>
                <a class="brand" href="{{ url('/dashboard') }}"><span class="first">coin</span> <span class="second">Wallet</span></a>
            </div>
        </div>

        <div class="sidebar-nav">
            <form class="search form-inline" />
                <input type="text" placeholder="Search..." />
            </form>

            <a href="#dashboard-menu" class="nav-header collapsed" data-toggle="collapse">
                <i class="icon-dashboard"></i>Dashboard<i class="icon-chevron-up"></i>
            </a>
            <ul id="dashboard-menu" class="nav nav-list collapse in">
                <li><a href="{{ url('/dashboard') }}">Home</a></li>
                <li><a href="{{ url('/coins') }}">Coins</a></li>
                <li><a href="{{ url('/transactions') }}">Transactions</a></li>
                <li><a href="calendar.html">Calendar</a></li>
            </ul>

            <a href="#accounts-menu" class="nav-header collapsed" data-toggle="collapse">
                <i class="icon-briefcase"></i>Coinbase<i class="icon-chevron-up"></i>
            </a>
            <ul id="accounts-menu" class="nav nav-list collapse">
                <li><a href="{{ url('/goals') }}">Goals</a></li>
                <li><a href="{{ url('/currentvalue') }}">Current Value</a></li>
                <li><a href="{{ url('/charts') }}">Charts</a></li>
            </ul>

            <a href="#error-menu" class="nav-header collapsed" data-toggle="collapse">
                <i class="icon-exclamation-sign"></i>CoinMarketCap<i class="icon-chevron-up"></i>
            </a>
            <ul id="error-menu" class="nav nav-list collapse">
                <li><a href="{{ url('/quotes') }}">Cryptocurrency</a></li>
                <li><a href="404.html">404 page</a></li>
                <li><a href="500.html">500 page</a></li>
                <li><a href="503.html">503 page</a></li>
            </ul>

            <a href="#legal-menu" class="nav-header collapsed"  data-toggle="collapse">
                <i class="icon-legal"></i>CoinGecko<i class="icon-chevron-up"></i>
            </a>
            <ul id="legal-menu" class="nav nav-list collapse">
                <li><a href="privacy-policy.html">Privacy Policy</a></li>
                <li><a href="terms-and-conditions.html">Terms and Conditions</a></li>
            </ul>

            <a href="help.html" class="nav-header"><i class="icon-question-sign"></i>Help</a>
            <a href="faq.html" class="nav-header"><i class="icon-comment"></i>Faq</a>
        </div>

        <div class="content">
    @yield('content')
</div>

        <script src="{{ url('/lib/bootstrap/js/bootstrap.js') }}"></script>

    </body>
</html>


