<!DOCTYPE html>
<html lang="en">
    <head>
        <title>NEMO - @yield('title')</title>
        @section('styles')
            <link rel="stylesheet" href="/d/common/base.css">
        @show
    </head>

    <body>
        @section('header')
            <a href="#">首页</a>
            <a href="#">搜搜</a>
            <a href="#">升级</a>
        @show

        @yield('content')

        @section('footer')
            <a href="#">关于我们</a>
            <a href="#">职业生涯</a>
            <a href="#">法律声明</a>
            <a href="#">站内统计</a>
            <a href="#">移动版</a>
        @show

        @section('scripts')
            <script src="/d/profile/index.js"></script>
        @show
    </body>
</html>
