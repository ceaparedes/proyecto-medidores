<?php

namespace App\Imports;

use App\Models\Marcas;
use App\Models\Medidores;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
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
        $marca = Marcas::where('nombre', $row[1])->first()->id;
        $usuario = User::where('name', $row[7])->first();
        
        $array_medidores = [

            'numero'     => $row[0],
            'marca_id'    => $marca,
            'diametro' => $row[2],
            'ano' => $row[3],
            'fecha_registro' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha)->format('Y-m-d'),
            'varal' => $row[5],
            'tuerca' => $row[6],
            'estado' => false,
            

        ];
        if($usuario){
            $array_medidores['usuario_id'] = $usuario->id;
        }
        return new Medidores($array_medidores);
    }

    
}
