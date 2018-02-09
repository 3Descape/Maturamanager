<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CanAddWorkingTimeMiddleware
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
        if (env('LOCKED')) {
            if (Carbon::now() > Carbon::createFromFormat('Y-m-d H:i:s', env('TIME'), 'Europe/Berlin') && $request->user()) {
                if (Gate::allows('admin', $request->user())) {
                    return $next($request);
                } else {
                    Auth::logout();
                    abort(307);
                }
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
