<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FirebaseAuth;
use Closure;

class UserAuth
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
        $user =new FirebaseAuth();
        if(session()->has('uid') && $user->isUser(session('uid')))
        return $next($request);
    else
        return redirect('/login');
    }
}
