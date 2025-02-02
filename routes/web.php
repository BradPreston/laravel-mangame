<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/account', [UserController::class, 'details']);
Route::get('/account/register', [UserController::class, 'create']);
Route::post('/account/register', [UserController::class, 'store']);
