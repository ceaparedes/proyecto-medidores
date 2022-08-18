<?php

namespace App\Http\Controllers;

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
            // dd($ordenes);
            return view('dashboard-trabajador', compact('ordenes'));
        }

    }
}
