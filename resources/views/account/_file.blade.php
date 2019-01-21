@component('files._file', compact('file'))
    @slot('links')
        <div class="level">
            <div class="level-left">
                <div class="level-item">
                    {{ $file->isFree() ? 'Free' : '$' . $file->price }}
                </div>

                @if (!$file->approvd)
                    <div class="level-item">
                        Pending approval
                    </div>
                @endif

                <div class="level-item">
                    {{ $file->live ? 'Live' : 'Not live' }}
                </div>

                <div class="level-item">
                    <a href="{{ route('account.files.edit', $file) }}">Make changes</a>
                </div>
            </div>
        </div>
    @endslot
@endcomponent
