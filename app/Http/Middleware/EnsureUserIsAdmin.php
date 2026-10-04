<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->withErrors(['role' => 'Δεν έχετε πρόσβαση σε αυτή τη σελίδα.']);
        }

        return $next($request);
    }
}
