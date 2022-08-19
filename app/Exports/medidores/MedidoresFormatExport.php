<?php

namespace App\Exports\medidores;

use App\Exports\MarcasExport;
use App\Exports\TrabajadoresExport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MedidoresFormatExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets() : array
    {
        $sheets = [
            new MedidoresBaseExport,//Base
            new MedidoresInstruccionesExport,//Instrucciones
            new MarcasExport,//Marcas
            new TrabajadoresExport,//Trabajadores
        ];

        return $sheets;
    }

}
