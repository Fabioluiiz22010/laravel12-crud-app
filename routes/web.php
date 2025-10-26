<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;


//route resource for products
Route::resource('/products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\TaskController;

// Aplicando o middleware 'authKey' a todas as rotas de tarefas
Route::middleware('authKey')->resource('tasks', TaskController::class);
