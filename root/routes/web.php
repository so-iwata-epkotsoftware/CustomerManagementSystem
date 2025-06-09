<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware('auth')
    ->prefix('customers')
    ->name('customers.')
    ->controller(CustomerController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index')->middleware('is_admin'); # 顧客一覧
        Route::get('{customer}', 'show')->name('show'); # 顧客詳細
        Route::get('create', 'create')->name('create'); # 顧客新規作成
        Route::get('{customer}/edit', 'edit')->name('edit'); # 顧客編集(staffは削除不可）
    });

// Route::resource('customers', CustomerController::class);


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';