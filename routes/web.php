<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[LoginController::class, 'index'])->name('login');
Route::post('/process-login',[LoginController::class, 'login'])->name('process-login');
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');
Route::get('/editar-perfil',[ProfileController::class, 'index'])->name('edit-profile');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');