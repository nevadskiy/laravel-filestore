@extends('account.layouts.default')

@section('account.content')
    <a href="https://connect.stripe.com/oauth/authorize?response_type=code&state=abc&scope=read_write&client_id={{ config('services.stripe_connect.key') }}">Connect your stripe account</a>
@endsection
