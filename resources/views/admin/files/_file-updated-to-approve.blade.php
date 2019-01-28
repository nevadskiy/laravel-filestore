@component('files._file', compact('file'))
    @slot('links')
        <div class="level">
            <div class="level-left">
                <div class="level-item">
                    <a href="#">Preview changes</a>
                </div>
                <div class="level-item">
                    <a role="button">Approve</a>
                </div>
                <div class="level-item">
                    <a role="button">Reject</a>
                </div>
            </div>
        </div>
    @endslot
@endcomponent
