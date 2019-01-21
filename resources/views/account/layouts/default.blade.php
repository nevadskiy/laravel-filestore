@extends('layouts.app')

@section('content')
    @include('account.layouts._stats')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-3">
                    @include('account.layouts._navigation')
                </div>
                <div class="column">
                    @include('layouts._flash')
                    @yield('account.content')
                </div>
            </div>
        </div>
    </section>
@endsection
