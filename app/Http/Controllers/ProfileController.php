<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function index(){
        $user = User::findOrFail(Auth::user()->id);
        // dd($user);

        return view('users.profile');
    }

    public function process_edit_profile(Request $request){

    }
}
