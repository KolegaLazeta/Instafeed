@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-8 offset-2 bg-light" style="border-radius: 25px">
        <h2 style="padding-left: 200px; padding-top:40px">Pratioci:</h2>
        
            @foreach($followers as $follower)
                @if($follower->following->contains(Auth::user()->id))
                     
                            <div class="pt-4 pb-3 text-dark" style="font-size: 20px; padding-left:200px; margin-bottom:10px ">
                                <a href="/profile/{{$follower->profile->id}}">
                                    <img src="{{$follower->profile->profileImage()}}" class="rounded-circle mr-2" style="max-width: 40px">
                                    <span class="text-dark">{{$follower->username}}</span>
                                </a>
                               
                                
                                </div>
                
                @endif
            @endforeach
        
</div>
@endsection
