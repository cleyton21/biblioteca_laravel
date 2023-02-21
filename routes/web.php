<?php

use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [HomeController::class, 'index'])->name('home.index');

// rota de usuarios
// Route::prefix('admin')->group(function () {
//     Route::get('/user', [UserController::class, 'index'])->name('user.index');
//     Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
//     Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
//     Route::get('/user/{slug}', [UserController::class, 'show'])->name('user.show');
//     Route::get('/user/{slug}/edit', [UserController::class, 'edit'])->name('user.edit');
//     Route::put('/user/{slug}/update', [UserController::class, 'update'])->name('user.update');
//     Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy')->where('id', '[0-9]+');
// });

Route::resources([
    'admin/user' => UserController::class,
]);

// rota de livros
Route::prefix('admin')->group(function () {
    Route::get('/livro', [LivroController::class, 'index'])->name('livro.index');
    Route::get('/livro/create', [LivroController::class, 'create'])->name('livro.create');
    Route::post('/livro/store', [LivroController::class, 'store'])->name('livro.store');
    Route::get('/livro/{slug}', [LivroController::class, 'show'])->name('livro.show');
    Route::get('/livro/{id}/edit', [LivroController::class, 'edit'])->name('livro.edit');
    Route::put('/livro/{id}/update', [LivroController::class, 'update'])->name('livro.update');
    Route::delete('/livro/delete/{id}', [LivroController::class, 'destroy'])->name('livro.destroy')->where('id', '[0-9]+');
});

// rota de emprestimo
Route::prefix('admin')->group(function () {
    Route::get('/emprestimo/livro/{id}/edit', [EmprestimoController::class, 'livro'])->name('emprestimo.livro.edit');
    Route::get('/emprestimo/user/{id}/edit', [EmprestimoController::class, 'user'])->name('emprestimo.user.edit');
    Route::put('/emprestimo/{id}/update', [EmprestimoController::class, 'update'])->name('emprestimo.update');
});


