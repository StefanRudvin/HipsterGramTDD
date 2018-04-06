<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();

        return response()->json([
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = $request->input('user_id');

        echo $request->input('post_id');

        $this->validate($request, [
            'content' => 'required'
        ]);

        $comment = Comment::create([
            'user_id' => $userId,
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
        ]);

        return response()->json([
            'comment' => $comment
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $comment->owner = $comment->user->name;

        $comment->time = $comment->created_at->diffforHumans();

        $comment->score = $comment->likesCount();

        $comment->img = $comment->user->avatar;

        return response()->json([
                    'comment' => $comment
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function ToggleLike(Comment $comment, Request $request)
    {
        $userId = $request->get('user_id');

        $comment->toggleLike($userId);
        $comment->save();
        $comment->score = $comment->likesCount();
        $comment->liked = $comment->isLiked($userId);
        $comment->owner = $comment->user->name;
        $comment->time = $comment->created_at->diffforHumans();
        $comment->img = $comment->user->avatar;
        return response()->json([
            'comment' => $comment
        ]);
    }


    public function isLiked(Comment $comment, Request $request)
    {
        $userId = $request->get('user_id');
        $liked = $comment->isLiked($userId);
        return response()->json([
            'liked' => $liked
        ]);
    }
}
