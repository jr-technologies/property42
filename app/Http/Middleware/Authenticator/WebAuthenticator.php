<?php

namespace App\Http\Middleware\Authenticator;

use App\Http\Responses\Responses\WebResponse;
use Closure;

class WebAuthenticator
{
    public $response;
    public function __construct(WebResponse $response)
    {
        $this->response = $response;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $customRequest)
    {
        $customRequest = ucfirst($customRequest);
        $customRequest = new $customRequest();
        if(!$customRequest->authenticate())
            return $this->response->setView('authenticationFails')->respond(['error'=>'user not authenticated']);
            return $next($request);
    }
}
