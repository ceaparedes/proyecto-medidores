<?php

namespace App\Exports;

use App\Models\Comunas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class ComunasExport implements FromCollection, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return Comunas::where('region_id', 13)->select('id', 'nombre')->get();
    }

    public function title(): string
    {
        return 'Comunas';
    }
}
