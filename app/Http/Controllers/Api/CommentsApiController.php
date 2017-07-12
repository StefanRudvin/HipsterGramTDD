<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;

class CommentsApiController extends Controller
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
        $this->validate($request, [
            'content' => 'required'
        ]);
        $comment = Comment::create([
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id,
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

    public function ToggleLike(Comment $comment)
    {
        $comment->toggleLike();
        $comment->save();
        $comment->score = $comment->likesCount();
        $comment->liked = $comment->isLiked();
        return response()->json([
                            'comment' => $comment
                        ]);
    }


    public function isLiked(Comment $comment)
    {
        $liked = $comment->isLiked();
        return response()->json([
                            'liked' => $liked
                        ]);
    }
}
