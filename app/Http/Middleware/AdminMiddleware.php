<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Closure $next)
    {
        if (! $request->user()?->is_admin) {
            abort(403, 'Unauthorized access. Admin privileges required.');
        }

        return $next($request);
    }
} 