<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $group = $request->path();

        // $group = explode("/", trim($group, "/"))[1];

        // var_dump($group);
        // var_dump(Auth::user()->posts());
        // return $next($request);

        // if ( Auth::check() && Auth::user()->posts() == $group)
        // {
        //     return $next($request);
        // }
        // return redirect('/denied');
    }
}
