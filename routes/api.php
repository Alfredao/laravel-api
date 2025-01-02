<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ExtratoController;

use App\Http\Controllers\UserPackageController;

use App\Http\Controllers\PacoteInvestimentoController;

use App\Http\Controllers\RentabilidadeController;

Route::get('/gerar-rendimentos', [RentabilidadeController::class, 'gerarRendimentosDiarios']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/pacotes/{id}', [PacoteInvestimentoController::class, 'show']);
    Route::post('/comprar-pacote', [PacoteInvestimentoController::class, 'comprar']);
});


Route::middleware('auth:sanctum')->get('/user/pacotes', [UserPackageController::class, 'index']);

Route::middleware('auth:sanctum')->get('/extrato', [ExtratoController::class, 'index']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth', 'throttle:6,1'])->group(function () {
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

