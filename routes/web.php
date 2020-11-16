<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
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
    Route::get('dasboard/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::group(['middleware'=>['role:super-admin']], function (){
        Route::get('dasboard/admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('dasboard/admin/create', [AdminController::class, 'store'])->name('admin.store');
        Route::get('dasboard/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    });

});

