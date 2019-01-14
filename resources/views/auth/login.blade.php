@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-6 is-offset-3">
                    <h1 class="title has-text-centered">Sign in</h1>

                    <form method="POST" action="{{ route('login') }}" class="box">
                        @csrf

                        <div class="field">
                            <label for="email" class="label">Email</label>
                            <div class="control">
                                <input
                                        id="email"
                                        class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                                        type="email"
                                        name="email"
                                        placeholder="Type your email"
                                        value="{{ old('email') }}"
                                >
                            </div>

                            @if ($errors->has('email'))
                                <p class="help is-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="password" class="label">Password</label>
                            <div class="control">
                                <input id="password" class="input" type="password" name="password" placeholder="Create your password">
                            </div>
                        </div>

                        <div class="field is-grouped level">
                            <div class="control">
                                <button class="button is-primary">Sign in</button>
                            </div>
                            <div class="control">
                                <a href="{{ route('password.request') }}" class="has-text-info">Forgotten your password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
