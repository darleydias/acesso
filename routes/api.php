<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\CartaoController;
use App\Http\Controllers\CartaoPessoaController;
use App\Http\Controllers\AcessoController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::group(['middleware'=>['auth:sanctum']],function(){
            // ########  CARTAO ################
            Route::get('/cartao',[CartaoController::class,'index']);
            Route::post('/cartao',[CartaoController::class,'store']);
            Route::get('/cartao/{id}',[CartaoController::class,'show']);
            Route::put('/cartao/{id}',[CartaoController::class,'update']);
            Route::delete('/cartao/{id}',[CartaoController::class,'destroy']);
            Route::post('/logout',[AuthController::class,'logout']);
});
            // ########  LOCAL ################
            Route::get('/local',[LocalController::class,'index']);
            Route::post('/local',[LocalController::class,'store']);
            Route::get('/local/{id}',[LocalController::class,'show']);
            Route::get('/local/acessos/{id}',[LocalController::class,'listaAcessos']);
            Route::put('/local/{id}',[LocalController::class,'update']);
            Route::delete('/local/{id}',[LocalController::class,'destroy']);

            // #################  CartaoPessoa #################
            Route::get('/cartaoPessoa',[CartaoPessoaController::class,'index']);
            Route::post('/cartaoPessoa',[CartaoPessoaController::class,'store']);
            Route::get('/cartaoPessoa/{id}',[CartaoPessoaController::class,'show']);
            Route::put('/cartaoPessoa/{id}',[CartaoPessoaController::class,'update']);
            Route::delete('/cartaoPessoa/{id}',[CartaoPessoaController::class,'destroy']);
            Route::get('/cartaoPessoa/valida/{codCartao}',[CartaoPessoaController::class,'testaCartao']);
            // #################  Acesso #################
            Route::get('/acesso',[AcessoController::class,'index']);
            Route::post('/acesso',[AcessoController::class,'store']);
            Route::get('/acesso/{id}',[AcessoController::class,'show']);
            Route::put('/acesso/{id}',[AcessoController::class,'update']);
            Route::delete('/acesso/{id}',[AcessoController::class,'destroy']);


