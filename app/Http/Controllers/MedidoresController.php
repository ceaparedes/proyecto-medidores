<?php

namespace App\Http\Controllers;

use App\Imports\MedidoresImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class MedidoresController extends Controller
{
    public function index(){

        return view('medidores.index');
    }

    public function import(){
        return view('medidores.import');
    }

    public function asignar_medidor(){
       return view('medidores.assign');
    }

    public function process_import(Request $request){
        
        Excel::import(new MedidoresImport, $request->file('archivo'));
        redirect('/medidores');
    }
}
