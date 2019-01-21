@extends('account.layouts.default')

@section('account.content')
    <h1 class="title">Make changes to {{ $file->title }}</h1>

    @if ($approval)
        @include('account.files._changes', compact('approval', 'file'))
    @endif
    
    <form action="{{ route('account.files.update', $file) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="field">
            <label for="title" class="label">{{ __('Title') }}</label>
            <div class="control">
                <label for="live" class="checkbox">
                    <input type="checkbox" name="live" id="live"{{ $file->live ? ' checked' : '' }}>
                    Live
                </label>
            </div>
        </div>

        <div class="field">
            <label for="title" class="label">{{ __('Title') }}</label>
            <div class="control">
                <input
                        id="title"
                        class="input{{ $errors->has('title') ? ' is-danger' : '' }}"
                        type="text"
                        name="title"
                        placeholder="Type title"
                        value="{{ old('title', $file->title) }}"
                >
            </div>

            @if ($errors->has('title'))
                <p class="help is-danger">{{ $errors->first('title') }}</p>
            @endif
        </div>

        <div class="field">
            <label for="overview_short" class="label">{{ __('Short overview') }}</label>
            <div class="control">
                <input
                        id="overview_short"
                        class="input{{ $errors->has('overview_short') ? ' is-danger' : '' }}"
                        type="text"
                        name="overview_short"
                        placeholder="Type overview_short"
                        value="{{ old('overview_short', $file->overview_short) }}"
                >
            </div>

            @if ($errors->has('overview_short'))
                <p class="help is-danger">{{ $errors->first('overview_short') }}</p>
            @endif
        </div>

        <div class="field">
            <label for="price" class="label">{{ __('Price ($)') }}</label>
            <div class="control">
                <input
                        id="price"
                        class="input{{ $errors->has('price') ? ' is-danger' : '' }}"
                        type="number"
                        name="price"
                        placeholder="Type price"
                        value="{{ old('price', $file->price) }}"
                >
            </div>

            @if ($errors->has('price'))
                <p class="help is-danger">{{ $errors->first('price') }}</p>
            @endif
        </div>

        <div class="field">
            <label for="overview" class="label">{{ __('Overview') }}</label>
            <div class="control">
                <textarea
                        id="overview"
                        class="textarea{{ $errors->has('overview') ? ' is-danger' : '' }}"
                        type="text"
                        name="overview"
                        placeholder="Type overview"
                >{{ old('overview', $file->overview) }}</textarea>
            </div>

            @if ($errors->has('overview'))
                <p class="help is-danger">{{ $errors->first('overview') }}</p>
            @endif
        </div>

        <div class="field is-grouped level">
            <div class="control">
                <button class="button is-primary">Submit</button>
            </div>
            <p>Your file changes may be subject to review</p>
        </div>
    </form>
@endsection