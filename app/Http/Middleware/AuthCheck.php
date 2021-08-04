<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {

        if( !session()->has('name')) {
            return redirect('login')->with('fail', 'You must be logged in');
        } else {
            return view('profile', [ 'username' => 'wthered1821'] );
        }

        return $next($request);
    }
}
