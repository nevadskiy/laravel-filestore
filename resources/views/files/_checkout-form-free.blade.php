<form action="{{ route('checkout.free', $file) }}" method="POST">
    @csrf

    <span class="field has-addons">
        <span class="control">
            <input type="email" name="email" class="input" id="email" required placeholder="you@somewhere.com" value="{{ old('email') }}">
        </span>

        <span class="control">
            <button class="button is-primary">Download for free</button>
        </span>
    </span>

    @if ($errors->has('email'))
        <span class="help is-danger">{{ $errors->first('email') }}</span>
    @endif
</form>
