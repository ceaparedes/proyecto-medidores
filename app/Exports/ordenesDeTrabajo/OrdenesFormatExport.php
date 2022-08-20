<?php

namespace App\Exports\ordenesDeTrabajo;

use App\Exports\ComunasExport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OrdenesFormatExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets() : array
    {
        $sheets = [
            new OrdenesBaseExport,//Base
            new OrdenesInstruccionesExport,//Instrucciones
            new ComunasExport,//Marcas
           
        ];

        return $sheets;
    }
}
