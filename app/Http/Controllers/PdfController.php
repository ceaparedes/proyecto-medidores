<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use PDF;
class PdfController extends Controller
{

   public function index(){
    
    $pdf = PDF::loadView('pdf.hoja-cambio');
    $pdf->setPaper('letter');
    return $pdf->stream('test.pdf');
   }
}
