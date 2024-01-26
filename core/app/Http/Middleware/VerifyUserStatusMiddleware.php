<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class VerifyUserStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->status == 0){
             //auth()->logout();
             $user = Auth::user()->token();
             $user->revoke();
             return response([
                'error' => 403,
                'message' => "User unauthorized !"
            ]);
        } 
        return $next($request);
    }
}
