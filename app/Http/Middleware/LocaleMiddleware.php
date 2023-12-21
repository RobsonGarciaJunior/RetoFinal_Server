<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Closure;
class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('language')) {
            if (App::getLocale()!= Session::get('language')) {
             App::setLocale(Session::get('language'));
            }
          }else {
             Session::put('language', 'es');
             App::setLocale('es');
         }
          return $next($request);
    }
}
