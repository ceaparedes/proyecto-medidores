<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresasRequest;
use App\Models\Empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresasController extends Controller
{
    
    public function index(){
        $empresas = Empresas::all();
        return view('empresas.index', compact('empresas'));
    }

    public function create(){
        return view('empresas.create');
    }
    
    public function store(EmpresasRequest $request){
        try {
           DB::beginTransaction(); 
            $empresa = new Empresas();
            $empresa->nombre = $request->nombre;
            $empresa->estado = $request->estado;
            $empresa->save();
            DB::commit();
            return redirect()->route('empresas.index')->with('success', '¡Empresa registrada con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('Ha ourrido un error, Cambio no registrado');
        }
    }

    public function edit($id){
        $empresa = Empresas::findOrFail($id);
        return view('empresas.edit', compact('empresa'));
    }

    public function update(EmpresasRequest $request, $id){
        try {
            DB::beginTransaction(); 
            $empresa = Empresas::findOrFail($id);
            $empresa->nombre = $request->nombre;
            $empresa->estado = $request->estado;
            $empresa->save();
            DB::commit();
            return redirect()->route('empresas.index')->with('success', '¡Empresa registrada con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('Ha ourrido un error, Cambio no registrado');
        }
    }

    public function destroy(Request $request){
        try {
            $empresa = Empresas::findOrFail($request->empresa);
            $empresa->delete();
            return redirect()->route('empresas.index')->with('success', '¡Empresa eliminada con éxito!');
        } catch (\Throwable $th) {
            return back()->withErrors('Ha ourrido un error, Empresa no eliminada');
        }
        
    }

    public function cambiar_estado($id){
        try {
            
            $empresa = Empresas::findOrFail($id);

            $empresa->estado = ($empresa->estado == 1)? 0: 1;
            $empresa->save();
            $text_label_estado = ($empresa->estado == 1) ? 'Activo' : 'Inactivo'; 
            return response()->json(["msg" => "Estado cambiado con éxito", 'text_label_estado' => $text_label_estado ]);
        } catch (\Throwable $th) {
            return back()->withErrors('Ha ourrido un error, Cambio de estado no realizado');
        }
    }
}
