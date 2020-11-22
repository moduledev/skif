<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
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

Route::middleware('verified')->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('dashboard/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::group(['middleware'=>['role:super-admin']], function (){
        Route::get('dashboard/admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('dashboard/admin/create', [AdminController::class, 'store'])->name('admin.store');
        Route::get('dashboard/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
        Route::get('dashboard/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');

        Route::get('dashboard/roles', [RoleController::class, 'index'])->name('role.index');
        Route::get('dashboard/role/{id}', [RoleController::class, 'show'])->name('role.show');
        Route::get('dashboard/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    });

});

