<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * @var array
     */
    protected $guards = [];

    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $token = $request->bearerToken();
        return $next($request);
    }
}
