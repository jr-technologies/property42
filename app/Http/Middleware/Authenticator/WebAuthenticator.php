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
     * @param   $customRequest
     * @return mixed
     */
    public function handle($request, Closure $next, $customRequest)
    {
        $customRequest = ucfirst($customRequest);
        $customRequest = new $customRequest();
        if($customRequest->isNotAuthentic())
            return 'putter kinda chore a tu?';
            //return $this->response->respondAuthenticationFailed();

        return $next($request);
    }
}
