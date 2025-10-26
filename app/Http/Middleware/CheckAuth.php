<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lógica de verificação simples:
        // Se o header "X-Auth-Key" não for igual a "12345", bloqueia.
        if ($request->header('X-Auth-Key') !== '12345') {
            return response()->json(['message' => 'Unauthorized. Missing valid X-Auth-Key.'], 401);
        }

        return $next($request);
    }
}