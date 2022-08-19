<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class TrabajadoresExport implements FromCollection, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::role('Trabajador')->select('id', 'name')->get();
    }

    public function title(): string
    {
        return 'Trabajadores';
    }
}
