<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  \String  $isAdmin
     * @return mixed
     * 
     */
    public function handle(Request $request, Closure $next,String $isAdmin )
    
        {
            if($isAdmin == 'profile' && auth()->user()->role_id == 2) {
                return redirect("auditor");
            }
            if($isAdmin == 'auditor' && auth()->user()->role_id == 1) {
                return redirect("profile");
            }
            return $next($request);
        }
}
