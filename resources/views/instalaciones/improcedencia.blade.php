@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Instalación Orden de Trabajo Servicio N° {{$orden->servicio}}</h1>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Formulario de Improcedencia</h4>
            <p class="card-description">
              Indique las causas y adjunte fotografías de la improcedencia
            </p>
            <form action="{{route('instalaciones.process-improcedencia', $orden->id)}}" method="post">
                @csrf
                @method('PUT')
              <div class="form-group">
                <label for="improcedencia">Causa</label>
                <select name="improcedencia" id="improcedencia"  class="custom-select d-block w-100" required>
                  <option value="" disabled="" selected="">Seleccione</option>
                  <option value="Casa deshabitada">Casa deshabitada</option>
                  <option value="Casa cerrada">Casa cerrada</option>
                  <option value="Negación del cliente">Negación del cliente</option>
                  <option value="Inconveniente Técnico">Inconveniente Técnico</option>
                  <option value="Medidor ya cambiado">Medidor ya cambiado</option>
                  <option value="Improcedencia">Improcedencia</option>
                </select>
              </div>
              
              
              <div class="form-group">
                <label for="observaciones">Observaciones (opcional)</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="4"></textarea>
              </div>
              <p class="card-description">
                Adjunte imagenes de respaldo de la improcedencia
              </p>
              <div class="col-sm-12">
              <div class="form-group">
                <label for="image-1">
                <img src="{{asset('/img/default-image.png')}}" alt="imagen-improcedencia" class="img-thumbnail" id="preview-image-1" width="200px" heigth="200px"></label>
                <input type="hidden" name="path_imagen[]" id="path-imagen-1">
                <input type="file" class="img_file" name="imagen[]" id="image-1" style="display:none" rel="1">
              </div>
              <div class="form-group">
                <label for="image-2">
                <img src="{{asset('/img/default-image.png')}}" alt="imagen-improcedencia" class="img-thumbnail" id="preview-image-2" width="200px" heigth="200px"></label>
                <input type="hidden" name="path_imagen[]" id="path-imagen-2">
                <input type="file" class="img_file" name="imagen[]" id="image-2" style="display:none" rel="2">
              </div>
              
              <div class="form-group">

                <label for="image-3">
                    <img src="{{asset('/img/default-image.png')}}" alt="imagen-improcedencia"class="img-thumbnail" id="preview-image-3" width="200px" heigth="200px"></label>
                    <input type="hidden" name="path_imagen[]" id="path-imagen-3">
                <input type="file" class="img_file" name="imagen[]" id="image-3" style="display:none" rel="3">
              </div>
              <div class="form-group">
                <label for="image-4">
                    <img src="{{asset('/img/default-image.png')}}" alt="imagen-improcedencia"class="img-thumbnail" id="preview-image-4" width="200px" heigth="200px"></label>
                    <input type="hidden" name="path_imagen[]" id="path-imagen-4">
                <input type="file" class="img_file" name="imagen[]" id="image-4" style="display:none" rel="4">
              </div>
            </div>
                <a href="{{route('instalaciones.index', $orden->id)}}" class="btn btn-secondary">Volver</a>
                <button type="submit" class="btn btn-primary">Cargar</button>
            </form>
          </div>
        </div>
      </div>

</div>
@endsection

@section('js')
<script src="{{asset('/js/carga-imagenes/carga-imagenes.js')}}"></script>


@if(session()->has('success'))
<script>
    swal({
        icon: "success",
        title: "{{ session()->get('success') }}"
    });
</script>
@endif

@if ($errors->any())
<script>
     let errors = `@foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach`;
     swal ( "Ups" , errors, "error" )
</script>
@endif

@endsection