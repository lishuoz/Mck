<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class CheckAdmin
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
        $isAdmin = false;
        foreach (Auth::user()->roles as $role) {
            if($role->pivot->role_id == 1){
                $isAdmin = true;
            }
        }
        if($isAdmin){
            return $next($request);
        }
        return redirect('/home');
    }
}
