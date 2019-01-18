<article class="media">
    <div class="media-content">
        <div class="content">
            <p>
                <strong>
                    <a href="#">{{ $file->title }}</a>
                </strong>
                <br>
                {{ $file->overview_short }}
            </p>
        </div>

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
                    <a href="#">Make changes</a>
                </div>
            </div>
        </div>
    </div>
</article>
