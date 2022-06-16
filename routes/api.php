<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Public routes
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => ['role:All|Master']], function () {

        Route::get('/users/', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::post('/users/', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->withTrashed()->name('users.show');
        Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->withTrashed()->name('users.edit');
        Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->withTrashed()->name('users.update');
        Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->withTrashed()->name('users.destroy');

        Route::get('/roles/', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
        Route::post('/roles/', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{role}', [App\Http\Controllers\RoleController::class, 'show'])->withTrashed()->name('roles.show');
        Route::get('/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->withTrashed()->name('roles.edit');
        Route::put('/roles/{role}', [App\Http\Controllers\RoleController::class, 'update'])->withTrashed()->name('roles.update');
        Route::delete('/roles/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->withTrashed()->name('roles.destroy');

    });
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});
