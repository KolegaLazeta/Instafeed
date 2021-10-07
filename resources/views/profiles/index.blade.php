@extends('layouts.app')

@section('content')
<div class="container" style="background-color:white; border-radius: 15px">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{$user->profile->profileImage()}}" class="rounded-circle w-100">
        </div>
    
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">

                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{ $user->username }}</div>

                    @if($user->id != auth()->user()->id)
                    <div><i ng-click="myfollow({{$user}});" class="glyphicon glyphicon-plus">
                        <follow-button user-id="{{$user->id}}" follows="{{ $follows }}"></follow-button>
                    </i></div>
                    @endif
                   
                    
                </div>


                @can('update', $user->profile)
                <a href="/p/create/">Add a new post</a>
                @endcan
            </div>

            @can ('update', $user->profile)
            <a href="/profile/{{$user->id}}/edit"><img class="pb-1" src="/storage/uploads/settings.png" style="max-width: 20px"> <span>Edit Profile</span></a>
            @endcan

            <div class="d-flex">
                <div class="pr-3"><strong>{{$postCount}} </strong>post</div>
                <a href="/profile/{{$user->id}}/followers" class="text-dark"> <div class="pr-3"><strong>{{$followersCount}} </strong>followers</div></a>
                <a href="/profile/{{$user->id}}/following" class="text-dark">  <div class="pr-3"><strong>{{$followingCount}} </strong>following</div></a>
            </div>
            <div class="pt-2">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="#">{{$user->profile->url}}</a></div>
        </div>
    </div>    
    <div class="row pt-5">
        @foreach ($user->posts as $post)
            <div class="col-4 pd-4 pb-4">
                <a href="/p/{{ $post->id}}">
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </a>
            </div>  
        @endforeach
        
    </div>
</div>
@endsection
