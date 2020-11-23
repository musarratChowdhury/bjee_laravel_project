<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserActive
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
        if (Auth::user()->status === 1) {
            return $next($request);
        }

		// dd('you are banned');
		Auth::guard('web')->logout();
        return redirect()->route('login')->with([
            'warning' => '<strong>Your account is deactivated.</strong>',
        ]);

    }
}
