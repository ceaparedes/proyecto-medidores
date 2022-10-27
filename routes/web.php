<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\InstalacionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\MedidoresController;
use App\Http\Controllers\OrdenesDeTrabajoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
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

Route::get('test-pdf', [PdfController::class, 'index']);

Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/process-login', [LoginController::class, 'login'])->name('process-login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::group(['middleware' => ['auth']], function () {


        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/carga-datos', [DashboardController::class, 'carga_datos'])->name('carga-datos');
        //Editar Perfil
        Route::get('/editar-perfil', [ProfileController::class, 'index'])->name('edit-profile');
        Route::post('/process-editar-perfil/{id}', [ProfileController::class, 'process_edit_profile'])->name('process-edit-profile');

        //Medidores
        Route::get('/medidores', [MedidoresController::class, 'index'])->name('medidores.index');
        Route::get('/medidores/importar', [MedidoresController::class, 'import'])->name('medidores.import');
        Route::post('/medidores/process-importar', [MedidoresController::class, 'process_import'])->name('medidores.process-import');
        Route::post('/medidores/process-asignar-medidor', [MedidoresController::class, 'process_asignar_medidor'])->name('medidores.process-asignar-medidor');
        Route::get('/medidores/exportar-plantilla', [MedidoresController::class, 'export'])->name('medidores.export');
        route::post('/medidores/get-medidor',[MedidoresController::class, 'get_medidor'])->name('medidores.get-medidor');
        route::post('/medidores/process-multi-asignacion',[MedidoresController::class, 'process_multi_asignacion'])->name('medidores.process-multi-asignacion');

        //Ordenes de Trabajo
        Route::get('/ordenes-de-trabajo', [OrdenesDeTrabajoController::class, 'index'])->name('ordenes-de-trabajo.index');
        Route::get('/ordenes-de-trabajo/listado-improcedencias', [OrdenesDeTrabajoController::class, 'listado_improcedencias'])->name('ordenes-de-trabajo.listado-improcedencias');
        Route::get('/ordenes-de-trabajo/listado-completadas', [OrdenesDeTrabajoController::class, 'listado_completadas'])->name('ordenes-de-trabajo.listado-completadas');
        Route::get('/ordenes-de-trabajo/importar', [OrdenesDeTrabajoController::class, 'import'])->name('ordenes-de-trabajo.import');
        Route::post('/ordenes-de-trabajo/process-importar', [OrdenesDeTrabajoController::class, 'process_import'])->name('ordenes-de-trabajo.process-import');
        Route::post('/ordenes-de-trabajo/process-asignar-medidor', [OrdenesDeTrabajoController::class, 'process_asignar_orden'])->name('ordenes-de-trabajo.process-asignar-orden');
        Route::get('/ordenes-de-trabajo/exportar-plantilla', [OrdenesDeTrabajoController::class, 'export'])->name('ordenes-de-trabajo.export');
        Route::get('/ordenes-de-trabajo/detalle/{id}', [OrdenesDeTrabajoController::class, 'detalle'])->name('ordenes-de-trabajo.detalle');
        route::post('/ordenes-de-trabajo/process-multi-asignacion',[OrdenesDeTrabajoController::class, 'process_multi_asignacion'])->name('ordenes-de-trabajo.process-multi-asignacion');
        route::get('/ordenes-de-trabajo/exportar-ordenes-realizadas', [OrdenesDeTrabajoController::class, 'ordenes_realizadas_export'])->name('ordenes-de-trabajo.exportar-ordenes-realizadas');
        //Instalaciones 
        Route::get('/instalaciones/{id}', [InstalacionesController::class, 'index'])->name('instalaciones.index');
        Route::get('/instalaciones/improcedencia/{id}', [InstalacionesController::class, 'improcedencia'])->name('instalaciones.improcedencia');
        Route::put('/instalaciones/process-improcedencia/{id}', [InstalacionesController::class, 'process_improcedencia'])->name('instalaciones.process-improcedencia');
        Route::get('/instalaciones/cambio/{id}', [InstalacionesController::class, 'cambio'])->name('instalaciones.cambio');
        Route::put('/instalaciones/process-cambio/{id}', [InstalacionesController::class, 'process_cambio'])->name('instalaciones.process-cambio');
        Route::post('/instalaciones/upload-image', [InstalacionesController::class, 'upload_image'])->name('instalaciones.upload-image');
        Route::post('/instalaciones/validar-lectura', [InstalacionesController::class, 'calcular_rango'])->name('instalaciones.validar-lectura');

        //Empresas
        Route::get('/empresas', [EmpresasController::class, 'index'])->name('empresas.index');
        Route::get('/empresas/crear', [EmpresasController::class, 'create'])->name('empresas.create');
        Route::post('/empresas/store', [EmpresasController::class, 'store'])->name('empresas.store');
        Route::get('/empresas/editar/{id}', [EmpresasController::class, 'edit'])->name('empresas.edit');
        route::put('/empresas/update/{id}', [EmpresasController::class, 'update'])->name('empresas.update');
        route::delete('/empresas/destroy', [EmpresasController::class, 'destroy'])->name('empresas.destroy');
        route::post('/empresas/cambiar-estado/{id}', [EmpresasController::class, 'cambiar_estado'])->name('empresas.cambiar-estado');

         //Empresas
         Route::get('/marcas', [MarcasController::class, 'index'])->name('marcas.index');
         Route::get('/marcas/crear', [MarcasController::class, 'create'])->name('marcas.create');
         Route::post('/marcas/store', [MarcasController::class, 'store'])->name('marcas.store');
         Route::get('/marcas/editar/{id}', [MarcasController::class, 'edit'])->name('marcas.edit');
         route::put('/marcas/update/{id}', [MarcasController::class, 'update'])->name('marcas.update');
         route::delete('/marcas/destroy', [MarcasController::class, 'destroy'])->name('marcas.destroy');
         route::post('/marcas/cambiar-estado/{id}', [MarcasController::class, 'cambiar_estado'])->name('marcas.cambiar-estado');
        
         //Usuarios
         Route::get('/usuarios', [UsersController::class, 'index'])->name('users.index');
         Route::get('/usuarios/crear', [UsersController::class, 'create'])->name('users.create');
         Route::post('/usuarios/store', [UsersController::class, 'store'])->name('users.store');
         Route::get('/usuarios/editar/{id}', [UsersController::class, 'edit'])->name('users.edit');
         route::put('/usuarios/update/{id}', [UsersController::class, 'update'])->name('users.update');
         route::delete('/usuarios/destroy', [UsersController::class, 'destroy'])->name('users.destroy');
         route::post('/usuarios/cambiar-estado/{id}', [UsersController::class, 'cambiar_estado'])->name('users.cambiar-estado');
    });
});

