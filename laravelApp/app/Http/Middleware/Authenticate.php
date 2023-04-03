<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $arr = [
            'status' => 401,
            'message' => "Unauthorized",
            'data' => null
          ];
        return $request->expectsJson() ? null : "/api/401";
    }

    
}
