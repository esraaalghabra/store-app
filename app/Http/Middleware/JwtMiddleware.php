<?php

namespace App\Http\Middleware;

use App\Helpers\HandelResponse;
use App\Helpers\StatusCodeRequest;
use Closure;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    use HandelResponse;
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException)
                return $this->handleResponse('Token is Invalid',StatusCodeRequest::UNAUTHORISED);
            else if ($e instanceof TokenExpiredException)
                return $this->handleResponse('Token is Expired',StatusCodeRequest::UNAUTHORISED);
            else
                return $this->handleResponse('Authorization Token not found',StatusCodeRequest::UNAUTHORISED);
        }

        return $next($request);
    }
}
