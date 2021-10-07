<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Notifications\LikeOnPost;

class LikeController extends Controller
{
    public function store(Post $post)
    {

        $like = auth()->user()->likes()->toggle($post->id);
        $post->user->notify(new likeOnPost($post));
        return redirect()->back();
    }

}
