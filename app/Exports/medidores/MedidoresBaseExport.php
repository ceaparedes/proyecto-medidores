<?php

namespace App\Exports\medidores;

use App\Models\Marcas;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class MedidoresBaseExport implements FromView, WithTitle, WithEvents, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.medidores.medidores-export');
    }

    public function title(): string
    {
        return 'Datos a cargar';
    }

    public function registerEvents(): array
    {
        
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $marcas = Marcas::select('id', 'nombre')->count();
                $validation_comuna = $event->sheet->getCell("B2")->getDataValidation();
                $validation_comuna->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST );
                $validation_comuna->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION );
                $validation_comuna->setAllowBlank(false);
                $validation_comuna->setShowInputMessage(true);
                $validation_comuna->setShowErrorMessage(true);
                $validation_comuna->setShowDropDown(true);
                $validation_comuna->setErrorTitle('Error');
                $validation_comuna->setError('No es una Marca válida.');
                $validation_comuna->setPromptTitle('Marca');
                $validation_comuna->setPrompt('Elija una marca de la lista.');
                $validation_comuna->setFormula1('\'Marcas\'!$B$1:$B$'.$marcas.'');
                $validation_comuna->setSqref('B2:B9999');
               
                $user = User::role('Trabajador')->select('id', 'name')->count(); 
                $validation_comuna = $event->sheet->getCell("H2")->getDataValidation();
                $validation_comuna->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST );
                $validation_comuna->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION );
                $validation_comuna->setAllowBlank(true);
                $validation_comuna->setShowInputMessage(true);
                $validation_comuna->setShowErrorMessage(true);
                $validation_comuna->setShowDropDown(true);
                $validation_comuna->setErrorTitle('Error');
                $validation_comuna->setError('No es un Trabajador válido.');
                $validation_comuna->setPromptTitle('Trabajador');
                $validation_comuna->setPrompt('Elija una Trabajador de la lista.');
                $validation_comuna->setFormula1('\'Trabajadores\'!$B$1:$B$'.$user.'');
                $validation_comuna->setSqref('H2:H9999');



            },
        ];
    }

   
}
