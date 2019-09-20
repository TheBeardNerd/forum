@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <img class="rounded-circle" src="{{ $profileUser->avatar() }}" alt="profile-avatar" width="100" height="100">
                @can('update', $profileUser)
                    {{-- Avatar Form --}}
                    <form action="{{ route('avatar', $profileUser) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input name="avatar" type="file" class="form-control-file mb-2">
                            <button type="submit" class="btn btn-info">Add Avatar</button>
                        </div>
                    </form>
                @endcan
                <div class="level">
                    <h1 class="d-inline flex">{{ $profileUser->name }}</h1>
                    <h5 class="d-inline">Since {{ $profileUser->created_at->diffForHumans() }}</h5>
                </div>
                <hr>

                @forelse($activities as $date => $activity)
                    <h3>{{ $date }}</h3>
                    <hr>
                    @foreach ($activity as $record)
                        @if (view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.{$record->type}", ['activity' => $record])
                        @endif
                    @endforeach
                @empty
                    <p>There is no activity for this user yet.</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection
