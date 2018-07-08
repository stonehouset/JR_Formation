<?php

namespace JR_Formation\Http\Middleware;

use Closure;

class Admin
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
        public function handle($request, Closure $next)
        {

            if (Auth::user() &&  Auth::user()->admin == 1) {

                return redirect('/admin.accueil_admin');

            }

            return redirect('/');   
        }
    }
}
