<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;
use Session;
class Merchant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::user()->role != "merchant"){
            // Session::flash('info','You do not have permission to access this page.');
            // return redirect()->back();
            return abort(404);
        }
        return $next($request);
    }
}
