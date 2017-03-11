<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\User;

use App\Comments;

use Image;

use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['admin']]);
    }

    public function updateAvatar(Request $request)
    {
        if ($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/uploads/avatars/' . $filename));
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return back();
    }

    public function show(User $user)
    {
        $posts = $user->posts()->get();

        $comments = $user->comments()->get();

        return view('user.index', compact('posts','comments', 'user'));
    }

    public function admin()
    {
        return view('admin.index');
    }

    public function ToggleFollow(User $user)
    {
        $user->toggleFollow();
        return back();
    }
}
