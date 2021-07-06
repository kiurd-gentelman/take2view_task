<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class VerifyApi extends BaseMiddleware
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

        if (session('jwt_token') == null){
            Auth::logout();
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect('/');
        }

//        dd($header = $request->header('Authorization'));
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                dd(2);
                Auth::logout();
//                return $request->wantsJson() ? new JsonResponse([], 204) : redirect('/login');

                return response()->json(['status' => 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                Auth::logout();
//                return $request->wantsJson() ? new JsonResponse([], 204) : redirect('/');

                return response()->json(['status' => 'Token is Expired']);
            }else{

                Auth::logout();
//                return $request->wantsJson() ? new JsonResponse([], 204) : redirect('/');
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return $next($request);
//        return $next($request);
    }
}
