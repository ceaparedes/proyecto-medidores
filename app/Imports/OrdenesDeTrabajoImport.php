<?php

namespace App\Imports;

use App\Models\OrdenesDeTrabajo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class OrdenesDeTrabajoImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new OrdenesDeTrabajo([
            'servicio' => $row[0],
            'codigo' => $row[1],
            'ruta' => $row[2],
            'nombre_cliente' => $row[3],
            'comuna_id' => $row[4],
            'direccion_cliente' => $row[5],
            'estado' => false
        ]);
    }

    
}
