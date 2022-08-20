<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){

         if (Auth::check()){
             return  redirect('/dashboard');
         }

        return view('login');
    }

    public function login(LoginRequest $request){
        try { 
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                return redirect()->intended('/dashboard');
            }else{
                return back()->withErrors('Usuario y/o Contraseña incorrectos');
            }
            
        } catch (\Throwable $th) {
            return back()->withErrors('Usuario y/o Contraseña incorrectos');
        }
       
    }

    public function logout(){
        Auth::logout();
 
        return redirect('/');    
    }
}
