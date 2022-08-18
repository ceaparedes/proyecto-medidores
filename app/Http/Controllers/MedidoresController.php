<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsignacionRequest;
use App\Http\Requests\ExcelRequest;
use App\Imports\MedidoresImport;
use App\Models\Medidores;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


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
      
        // dd($request->all());
        Excel::import(new MedidoresImport, $request->file('archivo'));
        return redirect()->route('medidores-index')->with('success', '¡Registros Cargados con éxito!');
    }

    public function process_asignar_medidor(AsignacionRequest $request){
        
        $medidor = Medidores::findOrFail($request->medidor);
        $medidor->usuario_id = $request->trabajador;
        $medidor->estado = true;
        $medidor->save();
        return redirect()->route('medidores-index')->with('success', '¡Medidor Asignado con éxito!');
    } 
}
