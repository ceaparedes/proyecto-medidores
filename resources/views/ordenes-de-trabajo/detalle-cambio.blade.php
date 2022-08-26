@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orden de Cambio de Medidor N° {{$orden->servicio}}</h1>
    </div>
    <div class="col-12 grid-margin">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Datos del Servicio </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">N° de Orden: </label>
                            <b class="col-sm-3 col-form-label">{{$orden->id}}</b>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fecha de Cambio:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->fecha_cambio->format('d-m-Y')}}</b>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">N°servicio:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->servicio}}</b>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ruta:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->ruta}}</b>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Direccion Cliente:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->direccion_cliente}}</b>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Localidad:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->comunas->nombre}}</b>
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nombre cliente:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->nombre_cliente}}</b>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Rut cliente:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->rut_persona_receptora}}</b>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Persona que atiende:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->rut_persona_receptora}}</b>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Número de Contacto:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->numero_contacto}}</b>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        
        {{-- <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Opciones</h6>
            </div>
            <div class="card-body">
                <a href="{{route('instalaciones.improcedencia', $orden->id)}}" class="btn btn-google btn-block">improcedencia</a>
                <a href="{{route('instalaciones.cambio', $orden->id)}}" class="btn btn-facebook btn-block">Cambio</a>
            </div>
        </div> --}}

    </div>
    <div class="col-lg-12 ">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Medidor Retirado</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">N° Serie: </label>
                                <b class="col-sm-3 col-form-label">{{$orden->medidor_actual_serie}}</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Diametro de Medidor: </label>
                                <b class="col-sm-3 col-form-label">{{$orden->medidor_actual_diametro}} mm</b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Año de fabricacion: </label>
                                <b class="col-sm-3 col-form-label">{{$orden->medidor_actual_ano}}</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ultima Lectura efectiva: </label>
                                <b class="col-sm-3 col-form-label">{{$orden->medidor_actual_volumen_total}}</b>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lectura al retirar: </label>
                                <b class="col-sm-3 col-form-label">{{$orden->medidor_actual_lectura_retiro}}</b>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-12 ">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Medidor Instalado</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Codigo del medidor: </label>
                                <b class="col-sm-3 col-form-label">{{$medidor->id}}</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Marca: </label>
                                <b class="col-sm-3 col-form-label">{{$medidor->marcas->nombre}} mm</b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Numero de Serie: </label>
                                <b class="col-sm-3 col-form-label">{{$medidor->numero}}</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Diametro: </label>
                                <b class="col-sm-3 col-form-label">{{$medidor->diametro}}</b>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Año de Fabricacion: </label>
                                <b class="col-sm-3 col-form-label">{{$medidor->ano}}</b>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Cambio de Varales: </label>
                                <b class="col-sm-3 col-form-label">{{$orden->varales}}</b>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Observación: </label>
                                <b class="col-sm-3 col-form-label">{{$orden->observaciones}}</b>
                            </div>
                        </div>

                       

                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-12 ">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Fotos</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{$orden->imagen_1}}" alt="imagen 1"  class="img-thumbnail imagen" width="200px" data-toggle="modal" data-target=".bd-example-modal-lg">
                        <img src="{{$orden->imagen_2}}" alt="imagen 2"  class="img-thumbnail imagen" width="200px" data-toggle="modal" data-target=".bd-example-modal-lg">
                        <img src="{{$orden->imagen_3}}" alt="imagen 3"  class="img-thumbnail imagen" width="200px" data-toggle="modal" data-target=".bd-example-modal-lg">
                        <img src="{{$orden->imagen_4}}" alt="imagen 4"  class="img-thumbnail imagen" width="200px" data-toggle="modal" data-target=".bd-example-modal-lg">
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <img src="" alt="imagen grande"  class="img-thumbnail"  id="img-modal">
      </div>
    </div>
  </div>


@endsection

@section('js')
<script>
$(document).on('click', '.imagen', function(){
    let img = $(this).attr('src');
    $('#img-modal').attr('src', img);
});
</script>
@endsection