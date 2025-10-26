<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken; 
use App\Http\Middleware\CheckAuth; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // A. REGISTRO DE ALIASES (para Middlewares aplicados via Route::middleware())
        $middleware->alias([
            // Seu middleware customizado usando camelCase
            'authKey' => CheckAuth::class, 
        ]);

        // B. CONFIGURAÇÃO DO GRUPO 'WEB' (Para desativar o CSRF em rotas de API/Postman)
        $middleware->web(append: [
            // Listando as rotas de recurso que o Postman deve ignorar.
            VerifyCsrfToken::except([
                'tasks', 
                'tasks/*',
                'products', 
                'products/*',
            ]),
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();