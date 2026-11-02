<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Admin has universal access
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Check if user has granular permission
        if (! $user->canAccess($permission)) {
            $allowedRoute = $user->firstAllowedRoute();

            if ($allowedRoute && $allowedRoute !== 'home' && \Illuminate\Support\Facades\Route::has($allowedRoute)) {
                return redirect()->route($allowedRoute)->with('error', 'Access restricted. You do not have permission to access that module.');
            }

            abort(403, 'Access restricted. You do not have permission to view this module. Please contact the administrator.');
        }

        return $next($request);
    }
}

