<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Hak_akses_dashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (in_array($request->user()->hak_akses, $role)) {
            return $next($request);
        }

        abort(404);

        // return redirect('/admin/auth/dashboard/login')->with('error', "Only admin can access!");
    }
}
