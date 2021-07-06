<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Support\Facades\Auth;

class VerifyJWTAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

//                dd($header = $request->header('Authorization'));
        if (session('jwt_token') == null){
            Auth::logout();
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect('/');
        }
        return $next($request);
    }
}
