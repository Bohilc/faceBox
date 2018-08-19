<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use App\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $user_id
     * @return void
     */
    public function index($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('friends.index', compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param int $friend_id
     * @return void
     */
    public function store($friend_id)
    {
//        Friend::create([
//            'user_id' => Auth::id(),
//            'friend_id' => $friend_id
//        ]);

        if (!friendship($friend_id)->exists) {

            Friend::create([
                'user_id' => Auth::id(),
                'friend_id' => $friend_id
            ]);
        }

        return back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param int $friend_id
     * @return void
     */
    public function update($friend_id)
    {
        Friend::where([
            'user_id' => $friend_id,
            'friend_id' => Auth::id(),
        ])->update([
            'accepted' => 1
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $friend_id
     * @return void
     */
    public function destroy($friend_id)
    {

        $test = Friend::where([
            'user_id' => Auth::id(),
            'friend_id' => $friend_id,
        ])->orWhere([
            'user_id' => $friend_id,
            'friend_id' => Auth::id(),
        ])->get();

        return back();
    }
}
