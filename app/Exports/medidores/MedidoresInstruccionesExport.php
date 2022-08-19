<?php

namespace App\Exports\medidores;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class MedidoresInstruccionesExport implements FromView, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.medidores.medidores-instrucciones');
    }

    public function title(): string
    {
        return 'Instrucciones';
    }
}
