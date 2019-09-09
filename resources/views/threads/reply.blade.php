<reply :attributes="{{ $reply }}" inline-template v-cloak>


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
                    @if (Auth::check())
                        <favorite :reply="{{ $reply }}"></favorite>
                    @endif

                    @can('update', $reply)
                        <button type="button" class="btn btn-light btn-sm mr-2" @click="editing = true">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" @click="destroy()"><i class="far fa-trash-alt"></i></button>
                    @endcan

                </div>
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>

                <button type="button" class="btn btn-info btn-sm" @click="update()">Update</button>
                <button type="button" class="btn btn-danger btn-sm" @click="cancel()"><i class="fas fa-ban"></i></button>
            </div>

            <div v-else v-text="body"></div>
        </div>
    </div>
</reply>
