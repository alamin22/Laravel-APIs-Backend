<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKey
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
        $key = $request->header('APP_KEY');
        if($key != '6mvU45GVjWG6J2Mge7xUjhM2dOXAoxqt9vxC'){
            return response()->json(['message'=>'Unauthorized API Access !'],401);
        }
        return $next($request);
    }
}
