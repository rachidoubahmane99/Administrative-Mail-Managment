<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FirebaseAuth;
use Closure;

class AdminAuth
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
        $admin =new FirebaseAuth();
        if(session()->has('uid') && $admin->isAdmin(session('uid')))
        return $next($request);
    else
        return redirect('/login');
    }
}
