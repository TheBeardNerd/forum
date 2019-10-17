@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="/css/vendor/jquery.atwho.css">
@endsection

@section('content')
<thread-view :thread="{{ $thread }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-header">
                        <div class="level">
                            <img src="/storage/{{ $thread->creator->avatar_path }}" alt="{{ $thread->creator->name }}" width="25" height="25" class="rounded-circle mr-2">
                            <span class="flex">
                                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                                <i class="fas fa-plus text-secondary mx-1"></i>
                                {{ $thread->title }}
                            </span>

                            @can ('update', $thread)
                                <form method="POST" action="{{ $thread->path() }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-small btn-link text-danger"><i class="far fa-trash-alt"></i></button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        <div>{{ $thread->body }}</div>
                    </div>
                </div>

                <div class="ml-5">

                    <replies @added="repliesCount++" @removed="repliesCount--"></replies>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-2">
                    <div class="card-body">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }} by
                        <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>, and currently has
                        <span v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}.
                    </p>

                    <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}" v-if="signedIn"></subscribe-button>

                    <button class="btn btn-danger ml-1"
                            v-if="authorize('isAdmin')"
                            @click="toggleLock"
                            v-text="locked ? 'Unlock' : 'Lock'">Lock</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
