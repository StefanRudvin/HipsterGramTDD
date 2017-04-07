<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Request::ajax())
            {
                $posts = Post::all();

                return response()->json([
                            'posts' => $posts
                        ]);
            }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.new');
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
        $post->title = $request->input('content');
        $post->content = $request->input('title');
        $post->user_id = Auth::user()->id;

        # Image handling
        // $avatar = $request->file('image');
        // $filename = time() . '.' . $avatar->getClientOriginalExtension();
        // Image::make($avatar)->save( public_path('/uploads/images/' . $filename));
        // $post->image = $filename;

        $post->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if(Request::ajax())
            {
                $post = Post::find($post->id);

                $post->time = $post->created_at->diffforHumans();

                $post->owner = $post->user->name;

                $post->userImg = $post->user->avatar;

                $post->score = $post->likesCount();

                return response()->json([
                            'post' => $post
                        ]);
            }

        $comments = $post->comments()->get();

        return view('posts.show', compact('post', 'comments'));
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

    public function ToggleLike(Post $post)
    {
        $post->toggleLike();
        $post->save();
        $post->score = $post->likesCount();
        $post->liked = $post->isLiked();
        return response()->json([
                            'post' => $post
                        ]);
    }


    public function isLiked(Post $post)
    {
        $liked = $post->isLiked();
        return response()->json([
                            'liked' => $liked
                        ]);
    }
}
