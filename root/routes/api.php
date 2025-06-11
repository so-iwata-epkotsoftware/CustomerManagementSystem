<?php

use App\Http\Controllers\User\getUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', [getUserController::class, 'index'])->middleware('auth:sanctum');
