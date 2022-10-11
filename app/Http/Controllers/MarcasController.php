<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcasRequest;
use App\Models\Marcas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcasController extends Controller
{
    
    public function index(){
        $marcas = Marcas::all();
        return view('marcas.index', compact('marcas'));
    }

    public function create(){
        return view('marcas.create');
    }
    
    public function store(MarcasRequest $request){
        try {
           
            DB::beginTransaction(); 
            $marca = new Marcas();
            $marca->nombre = $request->nombre;
            $marca->abreviatura = $request->abreviatura;
            $marca->estado = $request->estado;
            $marca->save();
            DB::commit();
            return redirect()->route('marcas.index')->with('success', '¡Empresa registrada con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('Ha ourrido un error, Cambio no registrado');
        }
    }

    public function edit($id){
        $empresa = Marcas::findOrFail($id);
        return view('marcas.edit', compact('empresa'));
    }

    public function update(MarcasRequest $request, $id){
        try {
            DB::beginTransaction(); 
            $marca = Marcas::findOrFail($id);
            $marca->nombre = $request->nombre;
            $marca->estado = $request->estado;
            $marca->abreviatura = $request->abreviatura;
            $marca->save();
            DB::commit();
            return redirect()->route('marcas.index')->with('success', '¡Empresa registrada con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('Ha ourrido un error, Cambio no registrado');
        }
    }

    public function destroy(Request $request){
        try {
            $empresa = Marcas::findOrFail($request->empresa);
            $empresa->delete();
            return redirect()->route('marcas.index')->with('success', '¡Empresa eliminada con éxito!');
        } catch (\Throwable $th) {
            return back()->withErrors('Ha ourrido un error, Empresa no eliminada');
        }
        
    }

    public function cambiar_estado($id){
        try {
            
            $empresa = Marcas::findOrFail($id);

            $empresa->estado = ($empresa->estado == 1)? 0: 1;
            $empresa->save();
            $text_label_estado = ($empresa->estado == 1) ? 'Activo' : 'Inactivo'; 
            return response()->json(["msg" => "Estado cambiado con éxito", 'text_label_estado' => $text_label_estado ]);
        } catch (\Throwable $th) {
            return back()->withErrors('Ha ourrido un error, Cambio de estado no realizado');
        }
    }
}
