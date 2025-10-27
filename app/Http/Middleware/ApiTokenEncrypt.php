<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenEncrypt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $encryptedToken = $request->header('X-Encrypted-Token');
        $secretKey = 'secret-api-key'; // Chave secreta esperada

        if (!$encryptedToken) {
            return response()->json(['mensagem' => 'Acesso negado. Token de criptografia ausente.'], 401);
        }

        try {
            // Tenta descriptografar o token
            $decryptedToken = Crypt::decryptString($encryptedToken);
        } catch (\Exception $e) {
            // Se a descriptografia falhar (token inválido/corrompido)
            return response()->json(['mensagem' => 'Acesso negado. Token de criptografia inválido.'], 401);
        }

        // Verifica se o valor descriptografado corresponde à chave secreta
        if ($decryptedToken !== $secretKey) {
            return response()->json(['mensagem' => 'Acesso negado. Token de criptografia incorreto.'], 401);
        }

        // Se passar nas verificações, continua o processamento
        return $next($request);
    }
}