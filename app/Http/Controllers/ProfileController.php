<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    
    public function index(){
        $user = User::findOrFail(Auth::user()->id);
        return view('users.profile', compact('user'));
    }

    public function process_edit_profile(ProfileRequest $request){
        try {
            DB::beginTransaction(); 
            $user = User::findOrFail(Auth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = $request->password;
            $user->save();
            DB::commit();
            return redirect()->route('dashboard')->with('success', '¡Datos editados con éxito!');
        } catch (\Throwable $th) {
            return response()->json(["msg" => "Ha ocurrido un error, datos no cambiados" ]);
        }
    }
}
