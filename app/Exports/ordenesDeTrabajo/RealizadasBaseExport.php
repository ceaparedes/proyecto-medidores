<?php

namespace App\Exports\ordenesDeTrabajo;

use App\Models\Marcas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RealizadasBaseExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets() : array
    {

        $sheets = array();

        $marcas = Marcas::get();
  
        foreach($marcas as $mar){
         
            $sheets[] = new MarcasExport($mar->id);
        }
        return $sheets;
    }
}
