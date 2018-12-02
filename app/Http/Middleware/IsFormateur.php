<?php

namespace JR_Formation\Http\Middleware;

use Closure;

class IsFormateur
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

        if ($request->user() && $request->user()->role != 1)
        {

            return redirect('login');


        }

        return $next($request);

    }
}
