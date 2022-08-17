<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedidoresController;
use App\Http\Controllers\ProfileController;

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

Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/process-login', [LoginController::class, 'login'])->name('process-login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::group(['middleware' => ['auth']], function () {


        Route::get('/editar-perfil', [ProfileController::class, 'index'])->name('edit-profile');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //Medidores
        route::get('/medidores', [MedidoresController::class, 'index'])->name('medidores-index');
        route::get('/medidores/importar', [MedidoresController::class, 'import'])->name('medidores-import');
        route::post('/medidores/process-importar', [MedidoresController::class, 'process_import'])->name('medidores-process-import');
    });
});
