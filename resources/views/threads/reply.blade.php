<div id="reply-{{ $reply->id }}" class="card mb-2">

    <div class="card-header bg-secondary text-white">
        <div class="level">
            <h6 class="flex">
                <a href="{{ route('profile', $reply->owner) }}">
                    {{ $reply->owner->name }}
                </a>
                <i class="fas fa-chevron-right fa-xs mx-1"></i>
                {{ $reply->created_at->diffForHumans() }}...
            </h6>

            <div>
                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-info" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div>{{ $reply->body }}</div>
    </div>

</div>
