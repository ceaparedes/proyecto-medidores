<?php

namespace App\Http\Controllers;

use App\Exports\medidores\MedidoresFormatExport;
use App\Http\Requests\AsignacionRequest;
use App\Http\Requests\ExcelRequest;
use App\Http\Requests\MultiMedidorRequest;
use App\Imports\MedidoresMultipleImport;
use App\Models\Medidores;
use App\Models\OrdenesDeTrabajo;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class MedidoresController extends Controller
{
    public function index(){
        
        $medidores = Medidores::with(['marcas', 'users'])->get();
        
        $trabajadores = User::role('Trabajador')->get();
       
        return view('medidores.index', compact('medidores', 'trabajadores'));
    }

    public function import(){
        return view('medidores.import');
    }

    public function asignar_medidor(){
       return view('medidores.assign');
    }

    public function process_import(ExcelRequest $request){
        try {
            Excel::import(new MedidoresMultipleImport, $request->file('archivo'));
            return redirect()->route('medidores.index')->with('success', '¡Registros Cargados con éxito!');
        } catch (\Throwable $th) {
            return back()->withErrors('Ha ocurrido un error, Importación no realizada');
        }
        
    }

    public function process_asignar_medidor(AsignacionRequest $request){
        try {
            DB::beginTransaction();
            $medidor = Medidores::findOrFail($request->medidor);
            $count_ordenes_trabajo = OrdenesDeTrabajo::where('usuario_id', $request->trabajador)->count();
            $medidores_usuario = Medidores::where([['usuario_id', $request->trabajador], ['id', '!=', $request->medidor]])->count();
            if($count_ordenes_trabajo > $medidores_usuario){
                $medidor->usuario_id = $request->trabajador;
                $medidor->save();
                DB::commit();
                return redirect()->route('medidores.index')->with('success', '¡Medidor Asignado con éxito!');
            }else{
                DB::rollBack();
                return back()->withErrors('El usuario seleccionado no puede tener mas medidor es asignados');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('Ha ocurrido un error, usuario no asignado');
        }
        
        
        
    } 

    public function export() 
    {   
        return Excel::download(new MedidoresFormatExport, 'Formato_medidores.xlsx');
    }

    public function get_medidor(Request $request){
        $medidor = Medidores::with('marcas')->findOrFail($request->medidor);
        return response()->json($medidor);
    }

    public function process_multi_asignacion(MultiMedidorRequest $request){
        try {
            // dd($request->all());
            DB::beginTransaction();
            foreach ($request->medidores as  $med) {
                $medidor = Medidores::findOrFail($med);                
                $medidor->usuario_id = $request->trabajador;
                $medidor->save();
            }
            DB::commit();
            return redirect()->route('medidores.index')->with('success', '¡Medidores Asignados con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack(); 
            return redirect()->route('medidores.index')->withErrors('Ha ocurrido un error, medidores no asignados');
           
        }
    }
}
