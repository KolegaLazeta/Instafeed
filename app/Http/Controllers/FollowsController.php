<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
    
        return auth()->user()->following()->toggle($user->profile); 
    }

    public function my_follow(Request $request, $id)
    {
    $user = auth()->user();

    if($user->id != $id && $otherUser = User::find($id)){

        $user->toggleFollow($otherUser);
    }

}
}
