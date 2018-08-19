<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('comment_permission', ['except' => ['store']]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comments_content = 'comments_content_' . $request['post_id'];
        $this->validate($request, [
            $comments_content => 'required|min:1'
        ], error_message());

        Comment::create([
            'post_id' => $request['post_id'],
            'user_id' => Auth::id(),
            'content' => $request[$comments_content]
        ]);

        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments.edit', compact('comment'));
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
        Comment::where('id', $request->comment)->update([
            'content' => $request->comment_content
        ]);
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
        Comment::where('id', $id)->delete();
        return back();
    }
}
