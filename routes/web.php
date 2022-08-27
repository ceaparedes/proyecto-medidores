<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstalacionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedidoresController;
use App\Http\Controllers\OrdenesDeTrabajoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

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

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/process-login', [LoginController::class, 'login'])->name('process-login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::group(['middleware' => ['auth']], function () {


        Route::get('/editar-perfil', [ProfileController::class, 'index'])->name('edit-profile');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //Medidores
        Route::get('/medidores', [MedidoresController::class, 'index'])->name('medidores.index');
        Route::get('/medidores/importar', [MedidoresController::class, 'import'])->name('medidores.import');
        Route::post('/medidores/process-importar', [MedidoresController::class, 'process_import'])->name('medidores.process-import');
        Route::post('/medidores/process-asignar-medidor', [MedidoresController::class, 'process_asignar_medidor'])->name('medidores.process-asignar-medidor');
        Route::get('/medidores/exportar-plantilla', [MedidoresController::class, 'export'])->name('medidores.export');
        route::post('/medidores/get-medidor',[MedidoresController::class, 'get_medidor'])->name('medidores.get-medidor');

        //Ordenes de Trabajo
        Route::get('/ordenes-de-trabajo', [OrdenesDeTrabajoController::class, 'index'])->name('ordenes-de-trabajo.index');
        Route::get('/ordenes-de-trabajo/listado-improcedencias', [OrdenesDeTrabajoController::class, 'listado_improcedencias'])->name('ordenes-de-trabajo.listado-improcedencias');
        Route::get('/ordenes-de-trabajo/listado-completadas', [OrdenesDeTrabajoController::class, 'listado_completadas'])->name('ordenes-de-trabajo.listado-completadas');
        Route::get('/ordenes-de-trabajo/importar', [OrdenesDeTrabajoController::class, 'import'])->name('ordenes-de-trabajo.import');
        Route::post('/ordenes-de-trabajo/process-importar', [OrdenesDeTrabajoController::class, 'process_import'])->name('ordenes-de-trabajo.process-import');
        Route::post('/ordenes-de-trabajo/process-asignar-medidor', [OrdenesDeTrabajoController::class, 'process_asignar_orden'])->name('ordenes-de-trabajo.process-asignar-orden');
        Route::get('/ordenes-de-trabajo/exportar-plantilla', [OrdenesDeTrabajoController::class, 'export'])->name('ordenes-de-trabajo.export');
        Route::get('/ordenes-de-trabajo/detalle/{id}', [OrdenesDeTrabajoController::class, 'detalle'])->name('ordenes-de-trabajo.detalle');
        //Instalaciones 
        Route::get('/instalaciones/{id}', [InstalacionesController::class, 'index'])->name('instalaciones.index');
        Route::get('/instalaciones/improcedencia/{id}', [InstalacionesController::class, 'improcedencia'])->name('instalaciones.improcedencia');
        Route::put('/instalaciones/process-improcedencia/{id}', [InstalacionesController::class, 'process_improcedencia'])->name('instalaciones.process-improcedencia');

        Route::get('/instalaciones/cambio/{id}', [InstalacionesController::class, 'cambio'])->name('instalaciones.cambio');
        Route::put('/instalaciones/process-cambio/{id}', [InstalacionesController::class, 'process_cambio'])->name('instalaciones.process-cambio');

        Route::post('/instalaciones/upload-image', [InstalacionesController::class, 'upload_image'])->name('instalaciones.upload-image');
        Route::post('/instalaciones/validar-lectura', [InstalacionesController::class, 'calcular_rango'])->name('instalaciones.validar-lectura');
        
    });
});

