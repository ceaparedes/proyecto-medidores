@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Importar Medidores</h1>
    </div>
    <p class="mb-4">En este espacio, puede cargar la información relacionada a los medidores. <br>
        Para descargar el formato <a target="_blank" href="{{route('medidores.export')}}">Pinche aqui</a>.</p>
    <div class="card shadow mb-4">

        <div class="card-body">

            <form action="{{route('medidores.process-import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="archivoAImportar">Archivo</label>
                    <input type="file" class="form-control-file" id="archivoAImportar" name="archivo">
                </div>

                <div>
                    <a href="{{route('medidores.index')}}" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-primary">Cargar</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@section('js')
@if ($errors->any())
<script>
     let errors = `@foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach`;
     swal ( "Ups" , errors, "error" );
</script>
@endif
@endsection