<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JWTMiddleware {

    public function handle($request, Closure $next, $guard = null){
        $token = $request->query('token');

        if(!$token){
            return response()->json([
                'message' => 'Token required!',
            ], 403);
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch (ExpiredException $e){
            return response()->json([
                'message' => 'Token expired!',
            ], 400);
        }

        $user = User::find($credentials->sub);

        $request->auth = $user;

        return $next($request);
    }
}
