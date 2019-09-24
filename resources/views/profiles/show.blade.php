@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <avatar-form :user="{{ $profileUser }}" class="d-flex align-items-center flex-column"></avatar-form>
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
