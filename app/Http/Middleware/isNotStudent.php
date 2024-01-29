<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

class isNotStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Check if the user is authenticated and not a student
        if ($user && !$user->roles->contains(Role::IS_STUDENT)) {
            return $next($request);
        }
        // If the user is not authenticated or is a student, deny access
        //abort(403);
        return redirect('/home');
    }
}
