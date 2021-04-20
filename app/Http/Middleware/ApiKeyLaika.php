<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyLaika
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
        if ($request->header('api-key-laika')) {
            return $next($request);
        }
        return response()->json(['El requerimiento no posee un api-key-laika válido.'],400);
    }
}
