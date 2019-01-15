@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-3">
                    @include('account.layouts._navigation')
                </div>
                <div class="column">
                    @yield('account.content')
                </div>
            </div>
        </div>
    </section>
@endsection
