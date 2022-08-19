<?php

namespace App\Exports;

use App\Models\Marcas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class MarcasExport implements FromCollection, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Marcas::select('id', 'nombre')->get();
    }

    public function title(): string
    {
        return 'Marcas';
    }
}
