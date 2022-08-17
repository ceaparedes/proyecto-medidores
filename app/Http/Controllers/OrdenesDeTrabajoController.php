<?php

namespace App\Http\Controllers;

use App\Imports\OrdenesDeTrabajoImport;
use App\Models\OrdenesDeTrabajo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrdenesDeTrabajoController extends Controller
{
    public function index(){
        $ordenes = OrdenesDeTrabajo::with('comunas')->get();

        return view('ordenes-de-trabajo.index', compact('ordenes'));
    }

    public function import(){
        return view('ordenes-de-trabajo.import');
    }

    public function process_import(Request $request){
        
        Excel::import(new OrdenesDeTrabajoImport, $request->file('archivo'));
        return redirect()->route('ordenes-de-trabajo-index');
    }
}
