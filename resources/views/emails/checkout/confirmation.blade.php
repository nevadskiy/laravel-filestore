@extends('emails.layouts.default')

@section('content')
    <p>Thanks for downloading <strong>{{ $sale->file->title }}</strong> from Filestore.</p>

    <p><a href="{{ route('files.download', [$sale->file, $sale]) }}">Download your file</a></p>

    <p>Or, copy and paste this into your browser:</p>
    <p>{{ route('files.download', [$sale->file, $sale]) }}</p>
@endsection
