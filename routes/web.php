<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    phpinfo();
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('dashboard/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::group(['middleware'=>['role:super-admin']], function (){
        Route::get('dashboard/admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('dashboard/admin/create', [AdminController::class, 'store'])->name('admin.store');
        Route::get('dashboard/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
        Route::get('dashboard/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');

        Route::get('dashboard/roles', [RoleController::class, 'index'])->name('role.index');
        Route::get('dashboard/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::get('dashboard/role/{id}', [RoleController::class, 'show'])->name('role.show');
        Route::get('dashboard/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('dashboard/role/edit/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::post('dashboard/role/store', [RoleController::class, 'store'])->name('role.store');
        Route::delete('dashboard/role/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');

        Route::get('dashboard/task',[TaskController::class, 'index'])->name('task.index');
        Route::get('dashboard/task/create',[TaskController::class, 'create'])->name('task.create');
        Route::post('dashboard/task/create',[TaskController::class, 'store'])->name('task.store');
        Route::get('dashboard/task/edit/{id}',[TaskController::class, 'edit'])->name('task.edit');
        Route::put('dashboard/task/update/{id}',[TaskController::class, 'update'])->name('task.update');
        Route::delete('dashboard/task/delete/{id}',[TaskController::class, 'delete'])->name('task.delete');

        Route::get('dashboard/info', [InfoController::class, 'index'])->name('info.index');

        //API
        Route::get('dashboard/tasks', [TaskController::class, 'getTasks']);
        Route::get('dashboard/task/{id}', [TaskController::class, 'getTask']);

    });

});

