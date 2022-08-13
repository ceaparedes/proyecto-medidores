<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'name' => 'Administrador',
            'guard_name' => 'web',
        ]);

        Roles::create([
            'name' => 'Trabajador',
            'guard_name' => 'web',
        ]);
    }
}
