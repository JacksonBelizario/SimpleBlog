<?php

namespace App\Http\Middleware;

use App\Models\Users;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
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

        if (!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Token não informado.',
            ], 401);
        }

        try {
            $credentials = JWT::decode($token, env('APP_KEY'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => 'Token expirado.',
            ], 401);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocorreu um erro ao decodificar o token.',
            ], 401);
        }

        $request->auth = Users::find($credentials->id);
        return $next($request);
    }
}
