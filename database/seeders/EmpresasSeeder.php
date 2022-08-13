<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresas;

class EmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresas::create([
            'nombre' => 'Essbio',
            'estado' => true,
        ]);
        Empresas::create([
            'nombre' => 'Aguas Araucanía',
            'estado' => true,
        ]);
    }
}
