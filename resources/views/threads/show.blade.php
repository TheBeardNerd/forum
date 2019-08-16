@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-2">

                <div class="card-header bg-info">
                    <a href="#">{{ $thread->creator->name }}</a>
                    <i class="fas fa-plus mx-1 text-white"></i>
                    {{ $thread->title }}
                </div>

                <div class="card-body">
                    <div>{{ $thread->body }}</div>
                </div>

            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 mb-2">
            @foreach ($thread->replies as $reply)
                @include('threads.reply')
            @endforeach
        </div>
    </div>

    @if (auth()->check())
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" class="form-control" id="body" placeholder="Leave a reply" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-info text text-white">Reply</button>
                </form>
            </div>
        </div>
    @else
        <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
    @endif
</div>
@endsection
