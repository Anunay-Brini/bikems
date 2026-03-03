<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            abort(403);
        }

        \Illuminate\Support\Facades\Log::info('RoleMiddleware Debug:', [
            'user__role' => auth()->user()->role,
            'required_roles' => $roles,
            'match' => in_array(auth()->user()->role, $roles)
        ]);

        $userRole = strtolower(auth()->user()->role);
        $allowedRoles = array_map('strtolower', $roles);

        if (!in_array($userRole, $allowedRoles)) {
            abort(403);
        }

        return $next($request);
    }
}
