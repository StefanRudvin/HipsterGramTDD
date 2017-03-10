<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\User;

use App\Comment;

use Carbon\Carbon;

use App\Http\Middleware\Owner;
use App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update,post', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete,post', ['only' => ['destroy']]);
    }

    public function test()
    {
        // $img = Image::make('testimg.jpg');
        // #$img = "Foo";
        // return view('imgtest', compact('img'));
        return view('imgtest');

        #$img = Image::canvas(800, 600, '#ff0000');
        #$img = Image::make('public/testImg.jpg')->resize(300, 200);
        #$img = Image::make('public/testImg.jpg');

        #return $img->response();
    }

    public function upload()
    {
        request()->file('avatar')->store('avatars');

        return back();
    }

    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.new');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:1',
            'title' => 'required|min:1'
            ]);

        $post = new Post($request->all());
        $post->user_id = Auth::user()->id;
        $post->save();
        $comments = $post->comments()->get();
        return view('posts.show', compact('post', 'comments'));
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        $comments = $post->comments()->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function destroy(Post $post)
    {
        return "This deletes current post. Not yet implemented";
    }

    public function ToggleLike(Post $post)
    {
        $post->toggleLike();
        return back();
    }

}
