<?php

use App\Friend;

function friendship($friend_id)
{

    $friendship = new stdClass();
    $friendship->exists = false;
    $friendship->accepted = false;

//    $friend_query = Friend::where([
//        'user_id' => Auth::id(),
//        'friend_id' => $friend_id,
//    ])->orWhere([
//        'user_id' => $friend_id,
//        'friend_id' => Auth::id(),
//    ])->first();
//

    $friend_query =
        Friend::where('user_id', Auth::id())
            ->where('friend_id', $friend_id)
            ->orWhere('user_id', $friend_id)
            ->where('friend_id', Auth::id())->first();


    if (!empty($friend_query)) {
        $friendship->exists = true;
        $friendship->accepted = $friend_query->accepted;
    }


    return $friendship;
}

function has_friend_invitation($friend_id)
{
    return Friend::where([
        'user_id' => $friend_id,
        'friend_id' => Auth::id(),
        'accepted' => 0,
    ])->exists();
}

function error_message()
{
    $Error_messages = [
        'required' => 'Pole jest wymagane',
        'min' => 'Minimum :min znaków',
    ];

    return $Error_messages;
}

function isUserLogin () {
    global $user;
    if (Auth::check() && $user->id !== Auth::id()){
        return true;
    } else {
        return false;
    }
};
