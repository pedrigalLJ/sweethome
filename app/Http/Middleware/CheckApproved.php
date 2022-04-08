<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApproved
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
        if ($request->user()->status == 0) {
            auth()->logout();

            return redirect()->route('login')->with('fail', 'Sorry to inform you that your registration has been declined. Thank you!');

        }
        if ($request->user()->status == 2) {
            auth()->logout();

            return redirect()->route('login')->with('message', 'Your account needs an administrator approval in order to log in. An email will sent after.');

        }
        return $next($request);
    }
}
