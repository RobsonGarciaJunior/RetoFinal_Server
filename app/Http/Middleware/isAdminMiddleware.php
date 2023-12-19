<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         if (!auth()->check() || !auth()->user()->roles->contains(Role::IS_ADMIN)){
             abort(code:403);
         }
            return $next($request);

        #if (auth()->check() && auth()->user()->roles->contains(1)){
        #    return $next($request);
        #}
        #return redirect()->route('login');
    }
}
