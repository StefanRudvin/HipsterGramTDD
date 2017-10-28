<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Post    $post
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Request $request)
    {
        $comments = $post->comments()->get();

        $userId  = $request->get('user_id');

        foreach( $comments as $comment ) {

            $comment->owner = $comment->user->name;

            $comment->time = $comment->created_at->diffforHumans();

            $comment->score = $comment->likesCount();

            $comment->liked = $comment->isLiked($userId);

            $comment->img = $comment->user->avatar;
            
        }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @param      $commentsid
     *
     * @return \Illuminate\Http\Response
     * @internal param Comment $comment
     */
    public function show(Post $post, $commentsid)
    {
        $comments = $post->comments()->get();

        $comment = $comments[$commentsid - 1];

        $comment->owner = $comment->user->name;

        $comment->time = $comment->created_at->diffforHumans();

        $comment->score = $comment->likesCount();

        #$comment->img = $comment->user->avatar;

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
}
