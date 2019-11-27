{{-- Editing the question --}}
<div class="card mb-2" v-if="editing">
    <div class="card-header">
        <div class="level">
            <span class="flex">
                <input class="form-control col-10" type="text" v-model="form.title">
            </span>

            @can ('update', $thread)
                <form method="POST" action="{{ $thread->path() }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-small btn-link text-danger p-1">Delete<i class="far fa-trash-alt ml-1"></i></button>
                </form>
            @endcan
        </div>
    </div>

    <div class="card-body">
        <div class="form-group">
            <textarea class="form-control" rows="6" v-model="form.body"></textarea>
        </div>
        <button type="submit" class="btn btn-sm btn-info text-light" @click="update">Update</button>
        <button type="submit" class="btn btn-sm btn-danger" @click="resetForm"><i class="fas fa-ban"></i></button>
    </div>
</div>


{{-- Viewing the question --}}
<div class="card mb-2" v-else>
    <div class="card-header">
        <div class="level">
            <img src="/storage/{{ $thread->creator->avatar_path }}" alt="{{ $thread->creator->name }}" width="25" height="25" class="rounded-circle mr-2">
            <span class="flex">
                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                <span><i class="fas fa-plus text-secondary mx-1"></i></span>
                <span v-text="title"></span>
            </span>

            <button v-if="authorize('owns', thread)" class="btn btn-small btn-link text-success p-1" @click="editing = true">Edit<i class="fas fa-edit ml-1"></i></button>

        </div>
    </div>

    <div class="card-body">
        <div v-text="body"></div>
    </div>
</div>
