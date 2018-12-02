<?php


namespace JR_Formation\Http\Middleware;


use Closure;

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

        if ($request->user() && $request->user()->role == 3)
        {

            return redirect('home');

        }

        if ($request->user() && $request->user()->role == 2)
        {

            return redirect('interface_client');

        }

        if ($request->user() && $request->user()->role == 1)
        {

            return redirect('interface_formateur');


        }

        if ($request->user() && $request->user()->role == 0)
        {

            return redirect('interface_apprenant');


        }


        return $next($request);

    }

}

