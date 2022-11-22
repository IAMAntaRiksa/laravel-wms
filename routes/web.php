<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SerialNumberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
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

Route::get('/', [LoginController::class, 'gate'])->name('login.gate');
Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::Post('login', [LoginController::class, 'login'])->name('login.login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('/role', RoleController::class, ['except' => ['show']])->names('role');

    Route::resource('/user', UserController::class, ['except' => ['show']])->names('user');

    Route::get('item/import', [ItemController::class, 'import'])->name('item.import');
    Route::post('item/import', [ItemController::class, 'importProcess'])->name('item.import-process');
    Route::resource('/item', ItemController::class, ['except' => ['show']]);

    Route::get('/serial-number/import', [SerialNumberController::class, 'import'])->name('serial-number.import');
    Route::post('/serial-number/import', [SerialNumberController::class, 'importProcess'])->name('serial-number.importProcess');
    Route::resource('/serial-number', SerialNumberController::class)->names('serial-number');

    Route::resource('/warehouse', WarehouseController::class, ['except' => ['show']]);
    Route::get('/warehouse/import', [WarehouseController::class, 'import'])->name('warehouse.import');
    Route::post('/warehouse/import', [WarehouseController::class, 'importProcess'])->name('warehouse.importProcess');

    Route::resource('/inventory', InventoryController::class, ['except' => ['show']]);


    Route::resource('/logistic', LogisticController::class, ['except' => ['show']]);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout.index');
});