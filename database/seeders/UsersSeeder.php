<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Víctor Cea',
            'email' => 'viceaparedes@gmail.com',
            'username' => 'vicea',
            'password' => Hash::make('vicea'),
            'estado' => true
        ]);

        User::create([
            'name' => 'Mauricio Vilugron',
            'email' => 'mvilugro@gmail.com',
            'username' => 'mauricio',
            'password' => Hash::make('mauricio'),
            'estado' => true
        ]);

        User::create([
            'name' => 'Jorge Admin',
            'email' => 'jorgeadmin@gmail.com',
            'username' => 'jorge_admin',
            'password' => Hash::make('jorge'),
            'estado' => true
        ]);

        User::create([
            'name' => 'Jorge Trabajador',
            'email' => 'jorgetrabajador@gmail.com',
            'username' => 'jorge_trabajador',
            'password' => Hash::make('jorge'),
            'estado' => true
        ]);
        
        
        DB::table('model_has_roles')->insert([
        	'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => 1
        ]);

        DB::table('model_has_roles')->insert([
        	'role_id' => 2,
            'model_type' => 'App\Models\User',
            'model_id' => 2
        ]);

        DB::table('model_has_roles')->insert([
        	'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => 3
        ]);

        DB::table('model_has_roles')->insert([
        	'role_id' => 2,
            'model_type' => 'App\Models\User',
            'model_id' => 4
        ]);
       
    }
}
