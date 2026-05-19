<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyAuthentication;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\EmprestimoController;

// --- ROTAS PÚBLICAS ---
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ROTA DE SOLICITAÇÃO (MOVEMOS PARA FORA DO MIDDLEWARE DO ADMIN)
// Agora o aluno consegue acessar, e a trava de segurança será feita no Controller
Route::post('/emprestimos/solicitar/{id}', [EmprestimoController::class, 'store'])
    ->name('emprestimos.store');


// --- ROTAS PRIVADAS (APENAS PARA ADMINS) ---
Route::middleware([VerifyAuthentication::class])->group(function() {
    
    // Gerenciamento de Usuários
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');         
    Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy'); 

    // Gerenciamento de Livros
    Route::get('/livros/create', [LivroController::class, 'create'])->name('livros.create');
    Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
    Route::get('/livros/{id}/edit', [LivroController::class, 'edit'])->name('livros.edit');
    Route::put('/livros/{id}', [LivroController::class, 'update'])->name('livros.update');
    Route::delete('/livros/{id}', [LivroController::class, 'destroy'])->name('livros.destroy');    

    // Gerenciamento de Empréstimos (Painel do Admin)
    Route::get('/emprestimos', [EmprestimoController::class, 'index'])->name('emprestimos.index');
    Route::post('/emprestimos/{id}/devolver', [EmprestimoController::class, 'devolver'])->name('emprestimos.devolver'); 
    
});