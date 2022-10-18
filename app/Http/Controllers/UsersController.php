<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\Empresas;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    
    public function index(){
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create(){
        $roles = Roles::all();
        return view('users.create' ,compact('roles'));
    }
    
    public function store(UsersRequest $request){
        try {
            
            DB::beginTransaction(); 
            $user = new User();
            $user->name = $request->nombre;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = Hash::make($request->username);
            $user->estado = $request->estado;
            $user->save();
            DB::commit();
            return redirect()->route('users.index')->with('success', '¡Usuario registrado con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('Ha ourrido un error, Cambio no registrado');
        }
    }

    public function edit($id){
        $empresa = User::findOrFail($id);
        $roles = Roles::all();
        return view('users.edit', compact('empresa', 'roles'));
    }

    public function update(UsersRequest $request, $id){
        try {
            DB::beginTransaction(); 
            $user = User::findOrFail($id);
            $user->name = $request->nombre;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->estado = $request->estado;
            $user->save();
            DB::commit();
            return redirect()->route('users.index')->with('success', '¡Usuario registrado con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('Ha ourrido un error, Cambio no registrado');
        }
    }

    public function destroy(Request $request){
        try {
            $user = User::findOrFail($request->user);
            $user->delete();
            return redirect()->route('user.index')->with('success', '¡Usuario eliminado con éxito!');
        } catch (\Throwable $th) {
            return back()->withErrors('Ha ourrido un error, Empresa no eliminada');
        }
        
    }

    public function cambiar_estado($id){
        try {
            
            $user = User::findOrFail($id);
            $user->estado = ($user->estado == 1)? 0: 1;
            $user->save();
            $text_label_estado = ($user->estado == 1) ? 'Activo' : 'Inactivo'; 
            return response()->json(["msg" => "Estado cambiado con éxito", 'text_label_estado' => $text_label_estado ]);
        } catch (\Throwable $th) {
            return back()->withErrors('Ha ourrido un error, Cambio de estado no realizado');
        }
    }

    public function get_empresas(){
        $empresas = Empresas::where([['estado', 1]])->get();
        $html = '';
        foreach ($empresas as  $emp) {
            $html.= '<option value="'.$emp->id.'">'.$emp->nombre.'</option>';
        }
        return response()->json(["msg" => "Empresas desplegadas con exito", 'html' => $html ]);
    }
}
