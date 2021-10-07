@extends('layouts.app')

@section('content')

    <div class="all d-flex">
        <div class="col-3"></div>

        <div class="container col-5">
            
            @foreach($posts as $post)
            
            
            <div class="row" style="background-color: white; border-radius: 15px">
                <div class="m-2" >
                    <a href="/p/{{$post->id}}">
                        <img src="/storage/{{$post->image}}" class="w-100">
                    </a>
                    <p class="pt-2 pl-2"><span class="font-weight-bold">
                        <img  src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100 mb-2" style="max-width: 30px">
                        <a href="/profile/{{$post->user->id}}">

                            <span class="text-dark"> {{$post->user->username}}
                            </span>
                        </a> {{$post->caption}}
                    </p>
                </div>  
                <div class="react pl-4">
                   
                    <div class="pb-4 ">
                        <div class="d-flex">
                        
                        <div class="">{{$post->likes()->count()}}<like-button likes="{{ $likes }}" post="{{$post->id}}" 
                            user-id="{{ auth()->user()->id }}"></like-button></div>
                        <a href="/p/{{$post->id}}"><div class="pl-3"><button class="btn btn-mini ">Comment</button></div></a>
                            
                            <div class="dropdown">
                                <button onclick="myFunction()" class="dropbtn btn btn-mini" >Share</button>
                                <div id="myDropdown" class="dropdown-content " style="border:none">
                                <a href="https://www.instagram.com/">Instagram</a>
                                <a href="https://www.facebook.com/">Facebook</a>
                                <a href="https://www.twitter.com/">Twitter</a>
                                </div>
                            </div>
                            
                        <hr>
                        </div>

                    </div>
                </div>
            </div>

            <hr>
            @endforeach
            
        </div>

        <div class="sticky col-4 " style="height: 50vh; position: -webkit-sticky; position: sticky; top: 30px; border-radius: 15px">
            <div class="overflow-hiden pb-4 resize:both" style=" width: 65%; background-color:rgb(255, 255, 255); border-radius: 15px;" >
                <h5 class="pl-4 pt-3"> Recomended profiles: </h5>
                   
                    @foreach($username as $user)
                    @if(auth()->user()->id != $user->id && !auth()->user()->following->contains($user->id))
                    <div class="pl-4 pt-4 text-dark" style="font-size: 20px"><a href="/profile/{{$user->profile->id}}">
                    <img src="{{$user->profile->profileImage()}}" class="rounded-circle mr-2" style="max-width: 40px">
                    <span class="text-dark">{{$user->username}}
                    </span></a>
                    <follow-button class="float-right pr-4" user-id="{{$user->id}}" follows="{{ $follows }}"></follow-button>
                    </div>
                    @endif
                    @endforeach
                
            </div>
        </div>
    
    </div>
@endsection
<script>
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }}}}
    </script>
