@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($threads as $thread)
                <div class="card mb-4">
                    <div class="card-header bg-info">
                        <div class="level">
                            <h4 class="flex mb-0">
                                <a href="{{ $thread->path() }}">
                                    {{ $thread->title }}
                                </a>
                            </h4>

                            <a href="{{ $thread->path() }}">
                                {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div>{{ $thread->body }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
