@extends('admin.layouts.default')

@section('admin.content')
    @if ($files->count())
        @each('admin.files._file-updated-to-approve', $files, 'file')
    @else
        <p>There are no updated files waiting for approval</p>
    @endif
@endsection
