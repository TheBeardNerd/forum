@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="level">
                    <h1 class="d-inline flex">{{ $profileUser->name }}</h1>
                    <h5 class="d-inline">Since {{ $profileUser->created_at->diffForHumans() }}</h5>
                </div>
                <hr>

                @foreach($threads as $thread)
                    <div class="card mb-2">
                        <div class="card-header bg-info">
                            <div class="level">
                                <span class="flex">
                                    <a href="#">{{ $thread->creator->name }}</a>
                                    <i class="fas fa-plus mx-1 text-white"></i>
                                    {{ $thread->title }}
                                </span>

                                <span class="text-white">
                                    {{ $thread->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>{{ $thread->body }}</div>
                        </div>
                    </div>
                @endforeach
                {{ $threads->links() }}
            </div>
        </div>
    </div>

@endsection
