<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        foreach( $posts as $post ) {
            $post->owner = $post->user->name;
            $post->time = $post->created_at->diffforHumans();
        }

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
        $this->validate($request, [
            'content' => 'required|min:1',
            'title' => 'required|min:1'
            ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;

        # Image handling
        // $avatar = $request->file('image');
        // $filename = time() . '.' . $avatar->getClientOriginalExtension();
        // Image::make($avatar)->save( public_path('/uploads/images/' . $filename));
        // $post->image = $filename;

        $post->save();

        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @param Request    $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Request $request)
    {
        $userId = $request->get('user_id');

        $post->userImg = $post->user->avatar;
        $post->owner = $post->user->name;
        $post->time = $post->created_at->diffforHumans();
        $post->score = $post->likesCount();
        $post->liked = $post->isLiked($userId);

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

    /**
     * @param Post    $post
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ToggleLike(Post $post, Request $request)
    {
        $userId = $request->get('user_id');
        $post->toggleLike($userId);
        $post->save();
        $post->score = $post->likesCount();
        $post->liked = $post->isLiked($userId);

        $post->userImg = $post->user->avatar;
        $post->owner = $post->user->name;
        $post->time = $post->created_at->diffforHumans();

        return response()->json([
            'post' => $post
        ]);
    }


    public function isLiked(Post $post, Request $request)
    {
        $userId = $request->get('user_id');
        $liked = $post->isLiked($userId);
        return response()->json([
            'liked' => $liked
        ]);
    }
}
