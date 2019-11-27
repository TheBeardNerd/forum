@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @include('threads._list')

            {{ $threads->render() }}
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Search
                </div>

                <div class="card-body">
                    <form action="/threads/search" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search for something..." aria-label="Search" aria-describedby="search">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit" id="search">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (count($trending))
                <div class="card">
                    <div class="card-header">
                        Trending Threads
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($trending as $thread)
                                <li class="list-group-item">
                                    <a href="{{ url($thread->path) }}">
                                        {{ $thread->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
