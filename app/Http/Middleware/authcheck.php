<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authcheck
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
        if(!session()->has('loggeduser') && ($request->path() != 'login' &&  $request->path() != 'signup' && $request->path() != 'driversignup'  )){
            return redirect('/login')->with('fail','You must login first');
        }

        if(session()->has('loggeduser')&& ($request->path()=='login' || $request->path() == 'signup')){
            return back();
        }
        return $next($request)->header('Cache-Control','no-cache,no-store,max-age=0,must-revalidate')
        ->header('Pragma','no-cache')
        ->header('Expires','sat 01 jan 1990 00:00:00 GMT');
    }
}
