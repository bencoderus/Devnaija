<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

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
if (Auth::guard($guard)->check()) {
return redirect('/dashboard');
$id = Auth::user()->id;
$date = date('Y-m-d H:i:s', time());
$user = User::find($id);
        $user->last_seen = $date;
        $user->save();
}

return $next($request);
}
}
