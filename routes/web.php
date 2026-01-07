<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ExamController;

// Ruta raíz: redirige al login si no estás autenticado
Route::get('/', function () {
    return redirect()->route('login');
});

// Todas las rutas que requieren usuario logueado
Route::middleware(['auth'])->group(function () {

    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    // Tareas
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

        // Rutas de Exámenes
    Route::get('/exam', [ExamController::class, 'index'])->name('exam.index');
    Route::post('/exam', [ExamController::class, 'store'])->name('exam.store');
    Route::put('/exam/{exam}', [ExamController::class, 'update'])->name('exam.update');
    Route::delete('/exam/{exam}', [ExamController::class, 'destroy'])->name('exam.destroy');
});

// Rutas de Breeze (login, register, logout)
require __DIR__.'/auth.php';
