<?php

namespace App\Http\Controllers;

use \App\Models\User; 
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProfilesController extends Controller
{



    public function index(User $user)
    {

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.posts'. $user->id,
            now()->addSeconds(30),
            function () use ($user) {
            return $user->posts->count();
        });
        $followersCount = Cache::remember(
            'count.followes'. $user->id,
            now()->addSeconds(30),
            function () use  ($user) {
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember(
            'count.following'. $user->id,
            now()->addSeconds(30),
            function () use  ($user) {
            return $user->following->count();
        });

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));

        

    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
  
    {
        $this->authorize('update', $user->profile);
        $data= request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);
       
        if(request('image')) {
            $imagePath = request('image')->store('uploads', 'public');  

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
        }
        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $imagePath],
        ));
        return redirect("/profile/{$user->id}");

        
    }

    public function following(){
        $follows =  User::all();
        return view('profiles.following', compact('follows'));
    }
    public function followers(){
        $followers = User::all();
        return view('profiles.followers', compact('followers'));
    }
   
    
}
