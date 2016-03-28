<?php

namespace App\Http\Middleware\Authorizer;

use Closure;

class ApiAuthorizer
{
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

        return $next($request);
    }
}
