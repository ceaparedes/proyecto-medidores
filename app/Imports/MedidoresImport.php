<?php

namespace App\Imports;

use App\Models\Medidores;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class MedidoresImport implements ToModel, WithStartRow
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
      
        
        $fecha = intval($row[4]);

        return new Medidores([

            'numero'     => $row[0],
            'marca_id'    => $row[1],
            'diametro' => $row[2],
            'ano' => $row[3],
            'fecha_registro' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha)->format('Y-m-d'),
            'varal' => $row[5],
            'tuerca' => $row[6],
            'estado' => false,
            'usuario_id' => $row[7]

        ]);
    }

    
}
