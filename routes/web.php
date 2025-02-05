<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/account', [UserController::class, 'index']);
Route::get('/account/register', [UserController::class, 'create']);
Route::get('/account/login', [UserController::class, 'login']);
Route::post('/account/register', [UserController::class, 'store']);
Route::get('/logout', [AuthenticateController::class, 'logout']);
Route::post('/login', [AuthenticateController::class, 'authenticate']);
