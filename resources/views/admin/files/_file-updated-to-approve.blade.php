@component('files._file', compact('file'))
    @slot('links')
        <div class="level">
            <div class="level-left">
                <div class="level-item">
                    <a href="{{ route('admin.files.show', $file) }}">Preview changes</a>
                </div>
                <div class="level-item">
                    <a role="button" onclick="event.preventDefault(); document.getElementById('approve-{{ $file->id }}').submit()">Approve</a>

                    <form action="{{ route('admin.files.updated.update', $file) }}" method="POST" id="approve-{{ $file->id }}" class="is-hidden">
                        @csrf
                        @method('PUT')
                    </form>
                </div>
                <div class="level-item">
                    <a role="button" onclick="event.preventDefault(); document.getElementById('reject-{{ $file->id }}').submit()">Reject</a>

                    <form action="{{ route('admin.files.updated.destroy', $file) }}" method="POST" id="reject-{{ $file->id }}" class="is-hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    @endslot
@endcomponent
