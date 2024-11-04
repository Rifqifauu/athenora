<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Cek apakah route yang diakses adalah admin
        if ($request->is('admin/*')) {
            // Redirect ke halaman login admin
            return route('admin.login');
        }

        // Default redirect ke halaman login user
        return $request->expectsJson() ? null : route('login');
    }
}
