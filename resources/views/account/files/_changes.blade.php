<article class="message is-primary">
    <div class="message-header">
        <p>We're currently reviewing the following changes</p>
    </div>
    <div class="message-body">
        <div class="content">
            @if ($approval->title !== $file->title)
                <strong>Title</strong>
                <p>{{ $approval->title }}</p>
            @endif

            @if ($approval->overview_short !== $file->overview_short)
                <strong>Short overview</strong>
                <p>{{ $approval->overview_short }}</p>
            @endif

            @if ($approval->overview !== $file->overview)
                <strong>Overview</strong>
                <p>{{ $approval->overview }}</p>
            @endif

            @if ($uploads = $file->uploads()->where('approved', false)->get())
                <strong>Uploads</strong>
                @foreach ($uploads as $upload)
                    <strong>Overview</strong>
                    <p>{{ $upload->filename }}</p>
                @endforeach
            @endif
        </div>
    </div>
</article>
