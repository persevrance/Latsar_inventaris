<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // belum login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // cek role
        if (auth()->user()->role !== $role) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
