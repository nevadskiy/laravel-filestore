@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-6 is-offset-3">
                    <h1 class="title has-text-centered">Recover your password</h1>

                    @if (session('status'))
                        <div class="notification is-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="box">
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
                            <div class="control">
                                <button class="button is-primary">Send password reset link</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
