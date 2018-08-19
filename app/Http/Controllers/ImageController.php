<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function user_avatar($id, $size) {
        $user = User::findOrFail($id);

        if(is_null($user->avatar)){
            $imgURL = 'https://cdn0.iconfinder.com/data/icons/user-pictures/100/unknown2-512.png';
            $img = Image::make($imgURL)->fit($size)->response('jpg', 90);
        }elseif(strpos($user->avatar, 'http') !== false ) {
            $img = Image::make($user->avatar)->fit($size)->response();
        } else {
            $avatar_path = asset('storage/users/' . $id . '/avatars' . '/' . $user->avatar);
            $img = Image::make($avatar_path)->fit($size)->response('jpg', 90);
        }

        return $img;
    }
}
