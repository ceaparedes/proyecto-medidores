<?php

namespace App\Imports;

use App\Models\Medidores;
use Maatwebsite\Excel\Concerns\ToModel;

class MedidoresImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        
        return new Medidores([

            'numero'     => $row[0],
            'marca'    => $row[1],
            'diametro' => $row[2],
            'ano' => $row[3],
            'varales' => $row[5],
            'tuercas' => $row[6],
            'usuario_id' => $row[7]

        ]);
    }
}
