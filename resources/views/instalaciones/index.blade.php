@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Instalación Orden de Trabajo Servicio N° {{$orden->servicio}}</h1>
    </div>
    <div class="col-12 grid-margin">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Información del Cliente</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nombre de Cliente: </label>
                            <b class="col-sm-3 col-form-label">{{$orden->nombre_cliente}}</b>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dirección Cliente:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->direccion_cliente}}</b>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Localidad:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->comunas->nombre}}</b>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ruta:</label>
                            <b class="col-sm-3 col-form-label">{{$orden->ruta}}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Información del Medidor</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">N° Serie Medidor: </label>
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
                            <label class="col-sm-3 col-form-label">Año de Medidor: </label>
                            <b class="col-sm-3 col-form-label">{{$orden->medidor_actual_ano}}</b>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Volumen: </label>
                            <b class="col-sm-3 col-form-label">{{$orden->medidor_actual_volumen_total}}</b>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fabricante: </label>
                            <b class="col-sm-3 col-form-label">{{$orden->medidor_actual_fabricante}}</b>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Modelo: </label>
                            <b class="col-sm-3 col-form-label">{{$orden->medidor_anterior_modelo}}</b>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Opciones</h6>
            </div>
            <div class="card-body">
                <a href="{{route('instalaciones.improcedencia', $orden->id)}}" class="btn btn-google btn-block">improcedencia</a>
                <a href="{{route('instalaciones.cambio', $orden->id)}}" class="btn btn-facebook btn-block">Cambio</a>
            </div>
        </div>

    </div>

</div>
@endsection