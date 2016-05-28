<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NEMO</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css">
        @section('styles')
            <link rel="stylesheet" href="/d/common/base.css">
        @show
    </head>

    <body>
        @section('header')
            <nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
                <!-- Left Side Of Navbar -->
                <a class="navbar-brand" href="#">YouI</a>
                <ul class="nav navbar-nav">
                    <li class="nav-item active"><a class="nav-link" href="{{ url('/home') }}">首页</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">搜搜</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">升级</a></li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav pull-xs-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" id="dropdownMenu2" class="dropdown-toggle" data-toggle="dropdown" data-target="#" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>

        @show

        @yield('content')

        @section('footer')
            <footer class="clearfix">
                <nav class="nav nav-inline pull-xs-left ">
                    <a class="nav-link" href="#">关于我们</a>
                    <a class="nav-link" href="#">职业生涯</a>
                    <a class="nav-link" href="#">法律声明</a>
                    <a class="nav-link" href="#">站内统计</a>
                    <a class="nav-link" href="#">移动版</a>
                </nav>
            </footer>
        @show

        @section('scripts')
            <script src="/node_modules/jquery/dist/jquery.min.js"></script>
            <script src="/node_modules/underscore/underscore-min.js"></script>
            <script src="/node_modules/tether/dist/js/tether.min.js"></script>
            <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="/d/profile/index.js"></script>
        @show
    </body>
</html>
