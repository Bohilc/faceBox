<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;

class UsersController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('user_permission', ['except' => ['show']]);
    }



    public function show($id)
    {
        global $user;
        $user = User::findOrFail($id);
//        $posts = Post::where('user_id', $id)->get(); // jest to samo co poniżej
        $posts = $user->posts()->get();
        return view('users.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // check if user is logged
//        if ($id != Auth::id()) {
//            abort(403, 'Brak dostępu');
//        };

        // messages if is errors
        $Error_messages = [
            'required' => 'Pole jest wymagane',
            'min' => 'Minimum 2 znaki',
            'unique' => 'Taki e-mail już istnieje',
        ];

        // validate data request
        $validatedData = $request->validate([
            'name' => 'required|min:2',
            'lastName' => 'required|min:2',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ]
        ], $Error_messages);


        // save user updates to the database
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->lastName = $request->lastName;
        $user->sex = $request->sex;
        $user->email = $request->email;

        if ($request->file('avatar')) {

            // if avatar is exits then delete old img
            if ($user->avatar) {

                Storage::delete('public/users/' . $id . '/avatars\/' . $user->avatar);
            }

            $user_avatar_path = 'public/users/' . $id . '/avatars';
            $upload_path = $request->file('avatar')->store($user_avatar_path);
            $avatar_file_name = str_replace($user_avatar_path . '/', '', $upload_path);
            $user->avatar = $avatar_file_name;
        };

        $user->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
