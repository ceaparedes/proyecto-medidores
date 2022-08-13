<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marcas;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marcas::create([
            'nombre' => 'SENSUS',
            'abreviatura' => 'SS',
        ]);
        Marcas::create([
            'nombre' => 'ELSTER',
            'abreviatura' => 'EL',
        ]);
        Marcas::create([
            'nombre' => 'ITRON',
            'abreviatura' => 'IT',
        ]);
    }
}
