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

            <div class="level">
                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-info mr-2" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} <i class="fas fa-crown"></i>
                    </button>
                </form>

                @can('update', $reply)
                    <form action="/replies/{{ $reply->id }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                    </form>
                @endcan
            </div>
        </div>
    </div>

    <div class="card-body">
        <div>{{ $reply->body }}</div>
    </div>

</div>
