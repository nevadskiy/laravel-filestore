@extends('layouts.plain')

@section('content')
    <section class="hero is-medium is-info">
        <div class="hero-body">
            <div class="container">
                @include('layouts._flash')

                <h3 class="subtitle is-spaced">
                    <strong>{{ $file->user->name }}</strong> is selling
                </h3>
                <h1 class="title is-1 is-spaced">{{ $file->title }}</h1>
                <h2 class="subtitle">
                    {{ $file->overview_short }}
                </h2>

                @if ($file->isFree())
                    @include('files._checkout-form-free')
                @else
                    @include('files._checkout-form')
                @endif
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="content">
                <div class="columns">
                    <div class="column">
                        <h2 class="title">Overview</h2>
                        <p>{{ $file->overview }}</p>
                    </div>
                    <div class="column">
                        <h2 class="title">What you get</h2>
                        @foreach ($uploads as $upload)
                            <p>{{ $upload->filename }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
