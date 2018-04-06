<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

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
            'title' => 'required|min:1',
            'image' => 'required'
            ]);

        $post = new Post();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->user_id = $request->get('user_id');

        # Image handling
        $imageData = $request->get('image');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('uploads/images/').$fileName);
        $post->image = $fileName;
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
