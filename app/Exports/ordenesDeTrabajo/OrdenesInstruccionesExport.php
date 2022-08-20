<?php

namespace App\Exports\ordenesDeTrabajo;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdenesInstruccionesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        return view('exports.ordenes-de-trabajo.instrucciones');
    }
}
