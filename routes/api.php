<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdutosApiController;

// Rotas de API protegidas pelo novo middleware
Route::middleware('apiTokenEncrypt')->group(function () {
    // Rotas de recurso para /api/produtos
    Route::resource('produtos', ProdutosApiController::class)->except(['create', 'edit']);
});