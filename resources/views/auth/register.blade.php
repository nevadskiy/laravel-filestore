@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-6 is-offset-3">
                    <h1 class="title has-text-centered">Let's get you ready for selling</h1>

                    <form method="POST" action="{{ route('register') }}" class="box">
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
                            <label for="name" class="label">Name</label>
                            <div class="control">
                                <input
                                        id="name"
                                        class="input"
                                        type="text"
                                        name="name"
                                        placeholder="Type your name"
                                        value="{{ old('name') }}"
                                >
                            </div>
                        </div>

                        <div class="field">
                            <label for="password" class="label">Password</label>
                            <div class="control">
                                <input id="password" class="input" type="password" name="password" placeholder="Create your password">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button class="button is-primary">Sign up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
