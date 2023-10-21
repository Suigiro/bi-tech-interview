<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PacientesController;

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

Route::controller(RegisterController::class)->group(function(){
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::controller(PacientesController::class)->group(function(){
    Route::get('/pacientes', 'index');
    Route::get('/paciente/{id}', 'show');
    Route::post('/paciente', 'create');
    Route::put('/paciente/{id}', 'update');
    Route::delete('/paciente/{id}', 'destroy');
});