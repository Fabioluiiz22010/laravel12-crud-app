<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutosController;


//route resource for products
Route::resource('/produtos', ProdutosController::class);

Route::get('/', function () {
    return view('welcome');
});
