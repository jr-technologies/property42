<?php

namespace App\Http\Middleware\Authenticator;

use App\Http\Responses\Responses\ApiResponse;
use Closure;

class ApiAuthenticator
{
    public $response;
    public function __construct(ApiResponse $response)
    {
        $this->response = $response;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param   $customRequest
     * @return mixed
     */
    public function handle($request, Closure $next, $customRequest)
    {
        $customRequest = ucfirst($customRequest);
        $customRequest = new $customRequest();
        if($customRequest->isNotAuthentic())
            return $this->response->respondAuthenticationFailed();

        return $next($request);
    }
}
