<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Admin
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
        
        $user = Auth::user();

        if(!$user || !$user->isAdmin() || !$user->is_active){
            return response()->view('errors.401', [], 401);
        }

        return $next($request);
    }
}
