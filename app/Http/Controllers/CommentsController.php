<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, Request $request)
    {

        $this->validate($request, [
            'content' => 'required|min:1'
            ]);

        $comment = new Comment($request->all());
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->save();
        return back();
    }

    public function show(Comment $comment)
    {
        $comments = $post->comments()->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function ToggleLike(Comment $comment)
    {
        $comment->toggleLike();
        return back();
    }

}
