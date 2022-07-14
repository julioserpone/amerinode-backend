<?php

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

Route::get('/countries/available/public', [App\Http\Controllers\CountryController::class, 'available'])->name('countries.available.public');

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

        Route::get('/permissions/', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
        Route::post('/permissions/', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permissions/{permission}', [App\Http\Controllers\PermissionController::class, 'show'])->withTrashed()->name('permissions.show');
        Route::get('/permissions/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->withTrashed()->name('permissions.edit');
        Route::put('/permissions/{permission}', [App\Http\Controllers\PermissionController::class, 'update'])->withTrashed()->name('permissions.update');
        Route::delete('/permissions/{permission}', [App\Http\Controllers\PermissionController::class, 'destroy'])->withTrashed()->name('permissions.destroy');

        Route::get('/technologies/', [App\Http\Controllers\TechnologyController::class, 'index'])->name('technologies.index');
        Route::post('/technologies/', [App\Http\Controllers\TechnologyController::class, 'store'])->name('technologies.store');
        Route::get('/technologies/{technology}', [App\Http\Controllers\TechnologyController::class, 'show'])->withTrashed()->name('technologies.show');
        Route::get('/technologies/{technology}/edit', [App\Http\Controllers\TechnologyController::class, 'edit'])->withTrashed()->name('technologies.edit');
        Route::put('/technologies/{technology}', [App\Http\Controllers\TechnologyController::class, 'update'])->withTrashed()->name('technologies.update');
        Route::delete('/technologies/{technology}', [App\Http\Controllers\TechnologyController::class, 'destroy'])->withTrashed()->name('technologies.destroy');

        Route::get('/oems/', [App\Http\Controllers\OemController::class, 'index'])->name('oems.index');
        Route::post('/oems/', [App\Http\Controllers\OemController::class, 'store'])->name('oems.store');
        Route::get('/oems/{oem}', [App\Http\Controllers\OemController::class, 'show'])->withTrashed()->name('oems.show');
        Route::get('/oems/{oem}/edit', [App\Http\Controllers\OemController::class, 'edit'])->withTrashed()->name('oems.edit');
        Route::put('/oems/{oem}', [App\Http\Controllers\OemController::class, 'update'])->withTrashed()->name('oems.update');
        Route::delete('/oems/{oem}', [App\Http\Controllers\OemController::class, 'destroy'])->withTrashed()->name('oems.destroy');

        Route::get('/statuses/', [App\Http\Controllers\StatusController::class, 'index'])->name('statuses.index');
        Route::post('/statuses/', [App\Http\Controllers\StatusController::class, 'store'])->name('statuses.store');
        Route::get('/statuses/{status}', [App\Http\Controllers\StatusController::class, 'show'])->withTrashed()->name('statuses.show');
        Route::get('/statuses/{status}/edit', [App\Http\Controllers\StatusController::class, 'edit'])->withTrashed()->name('statuses.edit');
        Route::put('/statuses/{status}', [App\Http\Controllers\StatusController::class, 'update'])->withTrashed()->name('statuses.update');
        Route::delete('/statuses/{status}', [App\Http\Controllers\StatusController::class, 'destroy'])->withTrashed()->name('statuses.destroy');

        Route::get('/companies/', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
        Route::post('/companies/', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
        Route::get('/companies/{company}', [App\Http\Controllers\CompanyController::class, 'show'])->withTrashed()->name('companies.show');
        Route::get('/companies/{company}/edit', [App\Http\Controllers\CompanyController::class, 'edit'])->withTrashed()->name('companies.edit');
        Route::put('/companies/{company}', [App\Http\Controllers\CompanyController::class, 'update'])->withTrashed()->name('companies.update');
        Route::delete('/companies/{company}', [App\Http\Controllers\CompanyController::class, 'destroy'])->withTrashed()->name('companies.destroy');
        Route::get('/companies/byCountry/{idCountry}', [App\Http\Controllers\CompanyController::class, 'companiesByCountry'])->withTrashed()->name('companies.companies_by_country');

        Route::get('/countries/', [App\Http\Controllers\CountryController::class, 'index'])->name('countries.index');
        Route::get('/countries/available', [App\Http\Controllers\CountryController::class, 'available'])->name('countries.available');
        Route::post('/countries/', [App\Http\Controllers\CountryController::class, 'store'])->name('countries.store');
        Route::get('/countries/{country}', [App\Http\Controllers\CountryController::class, 'show'])->withTrashed()->name('countries.show');
        Route::get('/countries/{country}/edit', [App\Http\Controllers\CountryController::class, 'edit'])->withTrashed()->name('countries.edit');
        Route::put('/countries/{country}', [App\Http\Controllers\CountryController::class, 'update'])->withTrashed()->name('countries.update');
        Route::delete('/countries/{country}', [App\Http\Controllers\CountryController::class, 'destroy'])->withTrashed()->name('countries.destroy');

        Route::get('/branches/', [App\Http\Controllers\BranchController::class, 'index'])->name('branches.index');
        Route::post('/branches/', [App\Http\Controllers\BranchController::class, 'store'])->name('branches.store');
        Route::get('/branches/{branch}', [App\Http\Controllers\BranchController::class, 'show'])->withTrashed()->name('branches.show');
        Route::get('/branches/{branch}/edit', [App\Http\Controllers\BranchController::class, 'edit'])->withTrashed()->name('branches.edit');
        Route::put('/branches/{branch}', [App\Http\Controllers\BranchController::class, 'update'])->withTrashed()->name('branches.update');
        Route::delete('/branches/{branch}', [App\Http\Controllers\BranchController::class, 'destroy'])->withTrashed()->name('branches.destroy');
    });

    Route::group(['middleware' => ['role:All|Project Admin']], function () {
        Route::get('/projects/', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');
        Route::post('/projects/', [App\Http\Controllers\ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'show'])->withTrashed()->name('projects.show');
        Route::get('/projects/{project}/edit', [App\Http\Controllers\ProjectController::class, 'edit'])->withTrashed()->name('projects.edit');
        Route::put('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'update'])->withTrashed()->name('projects.update');
        Route::delete('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'destroy'])->withTrashed()->name('projects.destroy');
    });

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});
