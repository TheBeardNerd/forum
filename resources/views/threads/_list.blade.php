@forelse ($threads as $thread)
    <div class="card mb-4">
        <div class="card-header">
            <div class="level">
                <div class="flex">
                    <h4>
                        <a href="{{ $thread->path() }}">
                            @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                <em>
                                    {{ $thread->title }}
                                </em>
                            @else
                                {{ $thread->title }}
                            @endif
                        </a>
                    </h4>

                    <h6>
                        <i class="fas fa-plus text-secondary mr-2"></i>
                        <a href="{{ route('profile', $thread->creator) }}">
                            {{ $thread->creator->name }}
                        </a>
                    </h6>
                </div>

                <a href="{{ $thread->path() }}">
                    {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}
                </a>
            </div>
        </div>

        <div class="card-body">
            <div>{{ $thread->body }}</div>
        </div>

        <div class="card-footer">
            {{ $thread->visits()->count() }} Visits
        </div>
    </div>
@empty
    <p>There are no relevant results at this time.</p>
@endforelse
