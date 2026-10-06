<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureToolsAreAllowed
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->is_restricted) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Tool access is restricted for this account. Contact support for help.',
                ], 403);
            }

            abort(403, 'Tool access is restricted for this account. Contact support for help.');
        }

        return $next($request);
    }
}
