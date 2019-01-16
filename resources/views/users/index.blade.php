@extends('layouts.app')

@section('content')
<div class="container text-primary">
    {{$user->username}}
    <hr>
    @if(Auth::user()->isNotTheUser($user))
        @if(Auth::user()->isFollowing($user))
        <a href="{{route('user.unfollow', $user)}}" class="btn btn-success">unfollow</a>
            
        @else
        <a href="{{route('user.follow', $user)}}" class="btn btn-primary">follow</a>
            
        @endif
    @endif
</div>
@endsection
