<?php

namespace App\Exports\ordenesDeTrabajo;

use App\Models\Comunas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class OrdenesBaseExport implements FromView, WithTitle, WithEvents, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        return view('exports.ordenes-de-trabajo.ordenes-export');
    }

    public function title(): string
    {
        return 'Datos a cargar';
    }

    public function registerEvents(): array
    {
        
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $comunas = Comunas::where('region_id', 13)->count();
                $validation_comuna = $event->sheet->getCell("E2")->getDataValidation();
                $validation_comuna->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST );
                $validation_comuna->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION );
                $validation_comuna->setAllowBlank(false);
                $validation_comuna->setShowInputMessage(true);
                $validation_comuna->setShowErrorMessage(true);
                $validation_comuna->setShowDropDown(true);
                $validation_comuna->setErrorTitle('Error');
                $validation_comuna->setError('No es una Comuna válida.');
                $validation_comuna->setPromptTitle('Comuna');
                $validation_comuna->setPrompt('Elija una Comuna de la lista.');
                $validation_comuna->setFormula1('\'Comunas\'!$B$1:$B$'.$comunas.'');
                $validation_comuna->setSqref('E2:E9999');
               
            },
        ];
    }
}
