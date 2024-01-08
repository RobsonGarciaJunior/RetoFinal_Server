<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AdminDegreeController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminModuleController;
use App\Http\Controllers\Admin\AdminHomeController;
use Illuminate\Support\Facades\Session;



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


Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->middleware('translate');

//Ruta para cambiar idioma
Route::get('/lang/{language}', function ($language) {
    Session::put('language',$language);
    return redirect()->back();
})->name('language');

Route::group(['middleware' => 'auth'], function () {
    //ROUTES FOR THE ADMIN
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        'as' => 'admin.',
    ],    function () {
        Route::resources([
            'home' => AdminHomeController::class,
        ]);
        Route::resources([
            'users' => AdminUserController::class,
        ]);
        Route::resources([
            'degrees' => AdminDegreeController::class,
        ]);
        Route::resources([
            'departments' => AdminDepartmentController::class,
        ]);
        Route::resources([
            'roles' => AdminRoleController::class,
        ]);
        Route::resources([
            'modules' => AdminModuleController::class,
        ]);
    })->middleware('translate');

    //ROUTES FOR THE USER
    Route::group([
        'middleware' => 'has_not_only_admin'], function () {
        Route::get('/home', [App\Http\Controllers\PersonalUser\HomeController::class, 'index'])->name('home');
        Route::get('/users', [App\Http\Controllers\PersonalUser\UserController::class, 'index'])->name('users.index');
        Route::get('/degrees', [App\Http\Controllers\PersonalUser\DegreeController::class, 'index'])->name('degrees.index');
        Route::get('/departments', [App\Http\Controllers\PersonalUser\DepartmentController::class, 'index'])->name('departments.index');
        Route::get('/departments/{department}', [App\Http\Controllers\PersonalUser\DepartmentController::class, 'show'])->name('departments.show');
    })->middleware('translate');
});
