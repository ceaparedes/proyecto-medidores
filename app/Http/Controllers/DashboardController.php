<?php

namespace App\Http\Controllers;

use App\Models\Medidores;
use App\Models\OrdenesDeTrabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        if(Auth::user()->hasRole('Administrador')){
                return view('dashboard-admin');
        }else{
            $ordenes = OrdenesDeTrabajo::with('comunas')->where([['usuario_id', Auth::user()->id], ['estado', false]])->get();
            $medidores = Medidores::where([['usuario_id', Auth::user()->id], ['estado', 0]])->count();
            return view('dashboard-trabajador', compact('ordenes', 'medidores'));
        }

    }
}
