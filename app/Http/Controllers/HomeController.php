<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function search(Request $request)
    {
          
            $search = $request->input('search');
        
            $users = User::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->get();
        
            // Return the search view with the resluts compacted
            return view('search', compact('users'));
    }
    
}
