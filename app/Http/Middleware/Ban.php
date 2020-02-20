<?php

namespace App\Http\Middleware;

use Closure;

class Ban
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
        if(auth()->check() && auth()->user()->ban ==1 )
        {
           return redirect('/banned')->with('error', 'You have banned from using this site!');
        }
        return $next($request);
    }
}
