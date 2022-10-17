<?php

namespace App\Http\Controllers;

use App\Exports\ordenesDeTrabajo\OrdenesFormatExport;
use App\Exports\ordenesDeTrabajo\RealizadasBaseExport;
use App\Http\Requests\AsignacionRequest;
use App\Http\Requests\ExcelRequest;
use App\Http\Requests\MultiOrdenesRequest;
use App\Imports\OrdenesDeTrabajoMultipleImport;
use App\Models\Medidores;
use App\Models\OrdenesDeTrabajo;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class OrdenesDeTrabajoController extends Controller
{
    public function index()
    {
        $ordenes = OrdenesDeTrabajo::with('comunas')->where([['estado', 0]])->get();

        $trabajadores = User::role('Trabajador')->get();
        return view('ordenes-de-trabajo.index', compact('ordenes', 'trabajadores'));
    }

    public function import()
    {
        return view('ordenes-de-trabajo.import');
    }

    public function process_import(ExcelRequest $request)
    {
        try {
            Excel::import(new OrdenesDeTrabajoMultipleImport, $request->file('archivo'));
            return redirect()->route('ordenes-de-trabajo.index')->with('success', '¡Registros Cargados con éxito!');
        } catch (\Throwable $th) {
            return back()->withErrors('Ha ocurrido un error con la Importación, proceso no realizado');
        }
    }

    public function process_asignar_orden(AsignacionRequest $request)
    {
        try {
            DB::beginTransaction();
            $orden = OrdenesDeTrabajo::findOrFail($request->orden);
            $orden->usuario_id = $request->trabajador;
            $orden->estado = false;
            $orden->save();
            DB::commit();
            return redirect()->route('ordenes-de-trabajo.index')->with('success', '¡Orden Asignada con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('Ha ocurrido un error, orden no asignada');
        }
        
    }

    public function export()
    {

        return Excel::download(new OrdenesFormatExport, 'Formato_ordenes.xlsx');
    }

    public function listado_improcedencias(){
        $ordenes = OrdenesDeTrabajo::with('comunas')->where([['estado', 2]])->get();
      
        return view('ordenes-de-trabajo.improcedencias', compact('ordenes'));
    }

    public function listado_completadas(){
        
        $ordenes = OrdenesDeTrabajo::with('comunas')->where([['ordenes_de_trabajos.estado', 1]])->get();
       
        return view('ordenes-de-trabajo.completadas', compact('ordenes'));
    }

    public function detalle($id){
        $orden = OrdenesDeTrabajo::with(['comunas', 'medidores' ])->findOrFail($id);
        if($orden->estado == 1){
            $medidor = Medidores::with(['marcas'])->findOrFail($orden->medidor_id);
            return view('ordenes-de-trabajo.detalle-cambio', compact('orden', 'medidor'));
        }else{
            return view('ordenes-de-trabajo.detalle-improcedencia', compact('orden'));
        }
        // dd($orden);
        
    }

    public function process_multi_asignacion(MultiOrdenesRequest $request){
        try {

            DB::beginTransaction();
            foreach ($request->ordenes as $ord) {
                $orden = OrdenesDeTrabajo::findOrFail($ord);                
                $orden->usuario_id = $request->trabajador;
                $orden->save();
            }
            DB::commit();
            return redirect()->route('ordenes-de-trabajo.index')->with('success', '¡Ordenes Asignados con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack(); 
            return redirect()->route('ordenes-de-trabajo.index')->withErrors('Ha ocurrido un error, Ordenes no asignadas');
           
        }
    }

    public function ordenes_realizadas_export(){
       
        return Excel::download(new RealizadasBaseExport, 'Ordenes_realizadas.xlsx');
    }
}
