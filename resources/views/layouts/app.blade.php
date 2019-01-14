<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts._head')
    </head>
<body>
    <div id="app">
        @include('layouts._navigation')
        @yield('content')
    </div>

    @include('layouts._scripts')
</body>
</html>
