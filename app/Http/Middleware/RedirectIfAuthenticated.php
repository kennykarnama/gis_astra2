<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                # code...
                if(Auth::guard($guard)->check()){
                    $page = "admin.dashboard";
                    return redirect()->route($page);    
                }
                
                break;
            
            default:
                # code...
                $page = "home";
                if(Auth::guard($guard)->check()){
                      return redirect()->route($page);
                }
              
                break;
        }
        // if (Auth::guard($guard)->check()) {
        //     return redirect(route($page));
        // }

        return $next($request);
    }
}
