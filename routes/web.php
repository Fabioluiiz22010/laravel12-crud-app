<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Garantir que está lá, se não estiver, adicione.
use App\Http\Controllers\ProdutosController; // <--- GARANTA ESTE IMPORT!
use App\Http\Controllers\ProfileController; // Import padrão do Breeze

// 1. ROTAS DO CRUD DE PRODUTOS (PROTEGIDAS)
// O grupo 'auth' garante que só usuários logados podem acessá-las
Route::middleware('auth')->group(function () {
    
    // A rota principal que estava dando 404
    Route::resource('produtos', ProdutosController::class);

    // Rotas de Perfil (adicionadas pelo Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// 2. ROTAS PÚBLICAS E HOME (ADICIONADAS PELO BREEZE)
Route::get('/', function () {
    // Redireciona o usuário para a dashboard (ou para a página de produtos)
    return redirect(Auth::check() ? '/produtos' : '/login');
});

// Inclui as rotas de autenticação (login, register, etc.) do Breeze
require __DIR__.'/auth.php';