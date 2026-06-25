<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', fn() => redirect()->route('login'));

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/perfil/editar', [AuthController::class, 'showEdit'])->name('edit');
    Route::put('/perfil/atualizar', [AuthController::class, 'update'])->name('update');
    Route::delete('/perfil/excluir', [AuthController::class, 'destroy'])->name('destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});