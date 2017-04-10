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
    
    public function index()
    {
        if(Request::ajax())
            {
                $users = User::all();

                return response()->json([
                            'users' => $users
                        ]);
            }

        $users = User::all();

        return view('user.index',compact('users'));
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
        if(Request::ajax())
            {
                $user = User::find($user);

                $user->score = $user->followsCount();

                return response()->json([
                            'user' => $user
                        ]);
            }

        $posts = $user->posts()->get();

        $comments = $user->comments()->get();

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

    public function ToggleFollow(User $user)
    {
        $user->toggleFollow();
        $user->save();
        $user->score = $user->followsCount();
        $user->followed = $user->isFollowed();
        return response()->json([
                            'user' => $user
                        ]);
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
