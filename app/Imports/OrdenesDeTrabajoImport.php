<?php

namespace App\Imports;

use App\Models\Comunas;
use App\Models\OrdenesDeTrabajo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class OrdenesDeTrabajoImport implements ToModel, WithStartRow, WithValidation
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
        $comuna = Comunas::where('nombre', $row[4])->first()->id;
        
        return new OrdenesDeTrabajo([
            'servicio' => $row[0],
            'ruta' => $row[1],
            'nombre_cliente' => $row[2],
            'direccion_cliente' => $row[3],
            'comuna_id' => $comuna,
            'medidor_actual_serie' => $row[5],
            'medidor_actual_ano' => $row[6],
            'medidor_actual_volumen_total' => $row[7],
            'medidor_actual_rango_m3' => $row[8],
            'medidor_actual_rango_m3_250' => $row[9],
            'medidor_actual_tecnologia' => $row[10],
            'medidor_actual_clase_metroilogica' => $row[11],
            'medidor_actual_rango_medicion' => $row[12],
            'medidor_actual_fabricante' => $row[13],
            'medidor_anterior_modelo' => $row[14],
            'medidor_actual_dispositivo_deteccion_fugas' => $row[15],
            'medidor_actual_diametro' => $row[16],
            'estado' => 0

        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required',
            '6' => 'required',
            '7' => 'required',
            '8' => 'required',
            '9' => 'required',
            '10' => 'required',
            '11' => 'required',
            '12' => 'required',
            '13' => 'required',
            '14' => 'required',
            '15' => 'required',
            '16' => 'required',
        ];
    }
}
