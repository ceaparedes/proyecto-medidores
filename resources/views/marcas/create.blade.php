@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Crear Nueva Empresa</h1>
    </div>

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="col-lg-8">
                <form action="{{route('empresas.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text"  class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="abreviatura">Abreviatura</label>
                        <input type="text"  class="form-control" id="abreviatura" name="abreviatura" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div>
                        <a href="{{route('empresas.index')}}" class="btn btn-secondary">Volver</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
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
     swal ( "Ups" , errors, "error" )
                                        
  

</script>  
@endif
@endsection