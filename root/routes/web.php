<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// 顧客
Route::middleware('auth')
    ->prefix('customers')
    ->name('customers.')
    ->controller(CustomerController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index'); # 顧客一覧
        Route::post('/', 'store')->name('store'); # 新規顧客処理
        Route::post('/{customer}/update', 'update')->name('update'); # 顧客新規作成
        Route::post('{customer}/destroy', 'destroy')->name('destroy'); # 顧客編集(staffは削除不可）
    });

// 対応履歴
Route::middleware('auth')
    ->prefix('interactions')
    ->name('interactions.')
    ->controller(InteractionController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index'); # 対応履歴一覧
        Route::get('{interaction}', 'show')->name('show'); # 対応履歴詳細
        Route::get('create', 'create')->name('create'); # 対応履歴新規作成
        Route::get('{interaction}/edit', 'edit')->name('edit'); # 対応履歴編集(staffは削除不可）
    });

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
