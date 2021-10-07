@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-8 offset-2 bg-light" style="border-radius: 25px">
        <h2 style="padding-left: 200px; padding-top:40px">Rezultat pretrage:</h2>
        
        @if($users->isNotEmpty())
            @foreach($users as $user)
                
                <div class="pt-4 pb-3 text-dark" style="font-size: 20px; padding-left:200px; margin-bottom:10px ">
                    <a href="/profile/{{$user->profile->id}}">
                        <img src="{{$user->profile->profileImage()}}" class="rounded-circle mr-2" style="max-width: 40px">
                            <span class="text-dark">{{$user->username}}</span>
                    </a>
                </div>
            
            @endforeach
        @else
            <div class="pt-4 pb-3 text-dark" style="font-size: 20px; padding-left:200px; margin-bottom:10px ">
                <h3>Ne postoji takav korisnik</h3>
            </div>
        @endif
        
</div>
@endsection
