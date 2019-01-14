<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts._head')
    </head>
<body>
    <div id="app">
        <section class="hero is-primary is-large">
            <div class="hero-head">
                @include('layouts._navigation')
            </div>
            @yield('content')
        </section>
    </div>

    @include('layouts._scripts')
</body>
</html>
