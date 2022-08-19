<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsignacionRequest;
use App\Http\Requests\ExcelRequest;
use App\Imports\OrdenesDeTrabajoImport;
use App\Models\OrdenesDeTrabajo;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class OrdenesDeTrabajoController extends Controller
{
    public function index(){
        $ordenes = OrdenesDeTrabajo::with('comunas')->get();
        
        $trabajadores = User::role('Trabajador')->get();
        return view('ordenes-de-trabajo.index', compact('ordenes', 'trabajadores'));
    }

    public function import(){
        return view('ordenes-de-trabajo.import');
    }

    public function process_import(ExcelRequest $request){
        
        Excel::import(new OrdenesDeTrabajoImport, $request->file('archivo'));
        return redirect()->route('ordenes-de-trabajo.index')->with('success', '¡Registros Cargados con éxito!');
    }

    public function process_asignar_orden(AsignacionRequest $request){
    
        $orden = OrdenesDeTrabajo::findOrFail($request->orden);
        $orden->usuario_id = $request->trabajador;
        $orden->estado = false;
        $orden->save();
        return redirect()->route('ordenes-de-trabajo.index')->with('success', '¡Orden Asignada con éxito!');
    } 
}
