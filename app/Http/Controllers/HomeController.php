<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['welcome']]);
    }

    public function admin()
    {
        return view('admin.index');
    }

    public function gitPull()
    {
        echo shell_exec("git pull");
        return;
    }

    public function changeVolume($volume = 100)
    {
        echo ("amixer set Master " . $volume . "% --c 1");
        echo shell_exec("amixer set Master " . $volume . "% --c 1");
        return "Volume changed to " . $volume;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function denied()
    {
        return view('admin.denied');
    }

    public function welcome()
    {
        return view('welcome');
    }

}
