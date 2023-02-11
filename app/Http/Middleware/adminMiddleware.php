<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $user = User::find(Auth::user()->id)->first();
        // $filter = $user->roles->role;

        // if ($filter) {
        //     if ($filter === 1) {
        //         return $next($request);
        //     }
        // }
        // return abort('403');

        if (Auth::user() &&  Auth::user()->roles->role == 1) {
            return $next($request);
        }

        return abort('403');
    }
}
