<?php

namespace App\Exports\ordenesDeTrabajo;

use App\Models\Marcas;
use App\Models\Medidores;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class MarcasExport implements FromView, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $marca;

    public function __construct($marca)
    {
        $this->marca = $marca;
    }

    
    public function title(): string
    {
        $marca = Marcas::findOrFail($this->marca);
        return $marca->nombre;
    }

    public function view() : View
    {
        $medidores = Medidores::leftJoin('ordenes_de_trabajos', 'ordenes_de_trabajos.medidor_id', '=', 'medidores.id')
        ->leftJoin('marcas', 'medidores.marca_id', '=', 'marcas.id')
        ->select(['marcas.abreviatura as abreviatura',
                  'medidores.numero', 
                  'ordenes_de_trabajos.medidor_nuevo_ano as ano',
                  'ordenes_de_trabajos.medidor_actual_diametro',
                  'ordenes_de_trabajos.medidor_nuevo_diametro',
                  'medidores.varal',
                  'medidores.tuerca'])
        ->whereNotNull(['ordenes_de_trabajos.medidor_id'])
        ->where([['medidores.marca_id', $this->marca]])
        ->get();
        return view('exports.ordenes-de-trabajo.marcas-instaladas', compact('medidores'));
    }
}
