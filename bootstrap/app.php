<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken; 
use App\Http\Middleware\ApiTokenEncrypt; // <-- NOVO MIDDLEWARE

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // GARANTINDO O CARREGAMENTO DA ROTA API
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // A. REGISTRO DE ALIASES: SOMENTE O NOVO MIDDLEWARE ESTÁ AQUI
        // Removemos o alias 'authKey' antigo, que causava o erro X-Auth-Key.
        $middleware->alias([
            'apiTokenEncrypt' => ApiTokenEncrypt::class, 
        ]);

        // B. CONFIGURAÇÃO DO GRUPO 'WEB' (Manter a exclusão do CSRF para rotas web)
        $middleware->web(append: [
            VerifyCsrfToken::except([
                'produtos', 
                'produtos/*',
            ]),
        ]);
        
        // C. CONFIGURAÇÃO DO GRUPO 'API' (Não precisa de alteração por enquanto)
        $middleware->api(prepend: [
            // Rotinas iniciais para API, mantidas como padrão do Laravel.
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();