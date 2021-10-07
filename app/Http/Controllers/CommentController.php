<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommentOnPost;


class CommentController extends Controller
{
 

    public function store(Request $request, Post $post)
    {
        $post = Post::findOrFail($request->post_id);
 
        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

        $post->user->notify(new CommentOnPost($post));
        
        return redirect()->back();
    }

    public function delete($id)
    {
            Comment::where('id',$id)->delete();
            return back();
    }

    
}
