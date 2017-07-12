<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersPostsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $user = User::find($user);

        $posts = $user->posts()->get();

        return response()->json([
                    'posts' => $posts
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
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $postid)
    {
        $user = User::find($user);

        $posts = $user->posts()->get();

        $post = $posts[$postid - 1];

        $post->time = $post->created_at->diffforHumans();

        $post->owner = $post->user->name;

        $post->userImg = $post->user->avatar;

        $post->score = $post->likesCount();

        return response()->json([
                    'post' => $post
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
