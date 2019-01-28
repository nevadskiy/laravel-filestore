@extends('layouts.app')

@section('content')
    @include('admin.layouts._stats')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-3">
                    @include('admin.layouts._navigation')
                </div>
                <div class="column">
                    @include('layouts._flash')
                    @yield('admin.content')
                </div>
            </div>
        </div>
    </section>
@endsection
