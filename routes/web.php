<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PersonalUser\UserController;
use App\Http\Controllers\PersonalUser\DegreeController;
use App\Http\Controllers\PersonalUser\DepartmentController;
use App\Http\Controllers\Admin\AdminDepartmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resources([
    'users' => UserController::class,
    'degrees' => DegreeController::class,
    'departments' => DepartmentController::class,
]);
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\PersonalUser\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        'as' => 'admin.',
    ],    function () {
        Route::get('/home', [App\Http\Controllers\Admin\AdminHomeController::class, 'index'])->name('home');
        Route::get('/users', [App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('users.index');
        Route::get('/degrees', [App\Http\Controllers\Admin\AdminDegreeController::class, 'index'])->name('degrees.index');
        Route::get('/departments', [App\Http\Controllers\Admin\AdminDepartmentController::class, 'index'])->name('departments.index');
        Route::get('/departments/{department}', [App\Http\Controllers\Admin\AdminDepartmentController::class, 'show'])->name('departments.show');
    });

    Route::group([
        'prefix' => 'user',
        'as' => 'user.',
], function () {
        Route::get('/users', [App\Http\Controllers\PersonalUser\UserController::class, 'index'])->name('users.index');
        Route::get('/degrees', [App\Http\Controllers\PersonalUser\DegreeController::class, 'index'])->name('degrees.index');
        Route::get('/departments', [App\Http\Controllers\PersonalUser\DepartmentController::class, 'index'])->name('departments.index');
        Route::get('/departments/{department}', [App\Http\Controllers\PersonalUser\DepartmentController::class, 'show'])->name('departments.show');
    });
});
