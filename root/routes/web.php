<?php

use App\Http\Controllers\Customers\CustomerController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Users\StaffUserController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => redirect('login'));

// 顧客
Route::middleware('auth')
    ->prefix('customers')
    ->name('customers.')
    ->controller(CustomerController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index'); # 顧客一覧
        Route::post('/', 'store')->name('store'); # 新規顧客登録処理
        Route::post('/{customer}/update', 'update')->name('update'); # 顧客更新処理
        Route::post('{customer}/destroy', 'destroy')->name('destroy')->middleware(EnsureIsAdmin::class); # 顧客削除処理(staff削除不可)
    });

// ユーザー(staffアクセス不可)
Route::middleware(['auth', EnsureIsAdmin::class])
    ->prefix('users')
    ->name('users.')
    ->controller(StaffUserController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index'); # ユーザー（staff）一覧
        Route::post('/', 'store')->name('store'); # 新規ユーザー（staff）登録処理
        Route::post('/{user}/update', 'update')->name('update'); # ユーザー（staff）更新処理
        Route::post('{user}/destroy', 'destroy')->name('destroy'); # ユーザー（staff）削除処理
    });

// 対応履歴
Route::middleware('auth')
    ->prefix('interactions')
    ->name('interactions.')
    ->controller(InteractionController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index'); # 対応履歴一覧
        Route::post('/', 'store')->name('store'); # 新規対応履歴登録処理
        Route::post('/{interaction}/update', 'update')->name('update'); # 対応履歴更新処理
        Route::post('{interaction}/destroy', 'destroy')->name('destroy')->middleware(EnsureIsAdmin::class); # 対応履歴削除処理(staff削除不可)
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
