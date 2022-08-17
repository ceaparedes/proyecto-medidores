<?php

namespace App\Http\Controllers;

use App\Imports\MedidoresImport;
use App\Models\Medidores;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class MedidoresController extends Controller
{
    public function index(){
        
        $medidores = Medidores::with(['marcas', 'users'])->get();
    
        return view('medidores.index', compact('medidores'));
    }

    public function import(){
        return view('medidores.import');
    }

    public function asignar_medidor(){
       return view('medidores.assign');
    }

    public function process_import(Request $request){
      
        // dd($request->all());
        Excel::import(new MedidoresImport, $request->file('archivo'));
        return redirect()->route('medidores-index');
    }
}
