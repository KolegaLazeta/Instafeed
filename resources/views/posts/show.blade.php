@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="background-color: white; border-radius:25px">
        <div class="col-8 mt-3 mb-3">
            <img src="/storage/{{$post->image}}" class="w-100">
        </div>    

        <div class="col-4 mt-3 mb-3" >
              <div>  
                <div class="d-flex align-items-center">
                    
                    <div class="pr-3">
                            <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width: 40px">
                    </div>
                    <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{$post->user->id}}">
                                <span class="text-dark">{{$post->user->username}}</span>
                            </a>
                            
                          
                        
                        </div>    
                    </div>  
                    
                </div>
                    <hr>  
                    <div class="d-flex">

                        <div class="col-sm-8">
                        <p><span class="font-weight-bold">
                        <a href="/profile/{{$post->user->id}}">
                            <span class="text-dark">{{$post->user->username}}
                            </span>
                        </a> {{$post->caption}}
                        </div>

                        @if(auth()->user()->posts()->find($post->id))
                        <div class="col-sm-4">
                            <form action="/p/delete/{{$post->id}}" method="POST">
                                @method('delete')
                                @csrf
                            <input type="submit" value="Delete Post" class="btn btn-outline-danger btn-sm">
                            </form>
                          
                        </div>
                        @endif
                    </div>
                        

                        <div class="pb-4 ">
                            <div class="d-flex">
                            
                            <div class="">{{$post->likes()->count()}}<like-button likes="{{ $likes }}" post="{{$post->id}}" user-id="{{ auth()->user()->id }}"></like-button></div>
                            <div class="pl-3">{{$post->comment()->count()}}<button class="btn btn-mini " onclick="Comment()">Comment</button></div>
                            
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

                            <div id="comment_section" class="comment-form pt-4" style="display:none;">
                                <form class="form-contact comment_form" action="/comments" id="commentForm" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <input type="text" name="post_id" value="{{$post->id}}" hidden>
                                   <div class="row">
                                      <div class="col-12">
                                         <div class="form-group">
                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="1" placeholder="Write Comment"></textarea>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="form-group">
                                      <button type="submit" class="btn btn-primary">Post Comment</button>
                                      
                                   </div>
                                </form>
                             </div>
                            @foreach ($post->comment as $comment)

                            <div class="pt-3 d-flex align-items-center">
                                <div class="font-weight-bold pr-2">
                                    
                                    <a href="/profile/{{$post->user->id}}">
                                     <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-10" style="max-width: 30px">
                                     <span class="pl-2 text-dark">{{$comment->user->username}}</span>
                                    </a>
                                </div>

                                
                                <div class="d-flex align-items-center">
                                
                                    <div >{{$comment->comment}}</div>

                                    <div class="ml-5 ">
                                        <a href="/delete/{{ $comment->id}}">
                                            <button type="submit" class="btn btn-default">Delete</button>
                                        </a>
                                </div>
                                </div>
                            </div>
                            @endforeach
                             <script>
                                function Comment() {
                                  var x = document.getElementById("comment_section");
                                  if (x.style.display === "none") {
                                    x.style.display = "block";
                                  } else {
                                    x.style.display = "none";
                                  }
                                }

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
                             
                        </div>

                        
                    </p>
              </div>
        </div>
    </div>
</div>
@endsection
