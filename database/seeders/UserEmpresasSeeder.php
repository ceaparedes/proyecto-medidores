<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserEmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'name' => 'Empresa',
            'guard_name' => 'web',
        ]);
        
        
        User::create([
            'name' => 'Usuario Empresa',
            'email' => 'empresa@gmail.com',
            'username' => 'empresa',
            'password' => Hash::make('empresa'),
            'estado' => 1,
            'empresa_id' => 1
        ]);

    }
}
