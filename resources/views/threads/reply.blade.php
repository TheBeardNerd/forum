<div class="card mb-2">

    <div class="card-header">
        <a href="#">
            {{ $reply->owner->name }}
        </a>
        <i class="fas fa-chevron-right fa-xs mx-1"></i>
        {{ $reply->created_at->diffForHumans() }}...
    </div>

    <div class="card-body">
        <div>{{ $reply->body }}</div>
    </div>

</div>
