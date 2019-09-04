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

                @foreach($activities as $date => $activity)
                    <h3>{{ $date }}</h3>
                    <hr>
                    @foreach ($activity as $record)
                        @include("profiles.activities.{$record->type}", ['activity' => $record])
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

@endsection
