<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WallsController extends Controller
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
     * @return string
     */
    public function index()
    {
        $friends = Auth::user()->friends();
        $friends_id_array = [];
        $friends_id_array[] = Auth::id();

        foreach ($friends as $friend) {

            $friends_id_array[] = $friend->id;
        }

        $posts = Post::whereIn('user_id', $friends_id_array)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('walls.index', compact('posts'));
    }
}
