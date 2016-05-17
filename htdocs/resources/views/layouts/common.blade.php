<!DOCTYPE html>
<html lang="en">
    <head>
        <title>NEMO - @yield('title')</title>
        @section('styles')
            <link rel="stylesheet" href="/d/common/base.css">
        @show
    </head>

    <body>
        @section('sidebar')
            This is the master sidebar.
        @show

        @yield('content')

        @section('scripts')
            <script src="/d/profile/index.js"></script>
        @show
    </body>
</html>
