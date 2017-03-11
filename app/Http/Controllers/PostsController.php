<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\User;

use App\Comment;

use Carbon\Carbon;

use Image;

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

        $post = new Post();
        $post->title = $request->input('content');
        $post->content = $request->input('title');
        $post->user_id = Auth::user()->id;

        # Image handling
        $avatar = $request->file('image');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->save( public_path('/uploads/images/' . $filename));
        $post->image = $filename;

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
        $this->validate($request, [
            'content' => 'required|min:1',
            'title' => 'required|min:1'
            ]);

        $post->title = $request->input('content');
        $post->content = $request->input('title');

        $post->user_id = Auth::user()->id;

        # Image handling
        if ($request->hasFile('image')){
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(600,600)->save( public_path('/uploads/images/' . $filename));
            $post->image = $filename;
        }

        $post->save();
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
