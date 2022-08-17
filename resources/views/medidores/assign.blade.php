@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Importar Medidores</h1>
    </div>
    <p class="mb-4">En este espacio, puede cargar la información relacionada a los medidores. <br>
        Para descargar el formato <a target="_blank" href="{{asset('public/archivos/formato_medidores.xlsx')}}">Pinche aqui</a>.</p>
    <form>
        <div class="card shadow mb-4">

            <div class="card-body">

                <form action="{{route('medidores-process-import')}}" method="POST">
                    
                 </div>   
            </div>
    </form>
</div>
</div>
@endsection