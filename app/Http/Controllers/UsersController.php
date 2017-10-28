<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function admin()
    {
        return view('admin.index');
    }
    
    public function index()
    {
        return view('user.index');
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $posts = $user->posts()->get();

        $user->score    = $user->followsCount();
        $user->followed = $user->followsCount();

        foreach ($posts as $post) {
            $post->userImg = $post->user->avatar;
            $post->owner   = $post->user->name;
            $post->time    = $post->created_at->diffforHumans();
            $post->score   = $post->likesCount();
            $post->liked   = $post->isLiked($user->id);
        }

        $comments = $user->comments()->get();

        foreach ($comments as $comment) {
            $comment->score = $comment->likesCount();
            $comment->liked = $comment->isLiked($user->id);
            $comment->owner = $comment->user->name;
            $comment->time  = $comment->created_at->diffforHumans();
            $comment->img   = $comment->user->avatar;
        }

        return view('user.show', compact('posts','comments', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function isFollowed(User $user)
    {
        $followed = $user->isFollowed();
        return response()->json([
                            'followed' => $followed
                        ]);
    }

    public function getFollows(User $user)
    {
        $score = $user->followsCount();
        return response()->json([
                            'score' => $score
                        ]);
    }


    
}
