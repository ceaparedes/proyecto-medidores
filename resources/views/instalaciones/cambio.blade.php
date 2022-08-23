@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Instalación Orden de Trabajo Servicio N° {{ $orden->servicio }}</h1>
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
                            <b class="col-sm-3 col-form-label">{{ $orden->medidor_actual_serie }}</b>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Diametro de Medidor: </label>
                            <b class="col-sm-3 col-form-label">{{ $orden->medidor_actual_diametro }} mm</b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Año de Medidor: </label>
                            <b class="col-sm-3 col-form-label">{{ $orden->medidor_actual_ano }}</b>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ultima Lectura del medidor: </label>
                            <b class="col-sm-3 col-form-label">{{ $orden->medidor_actual_volumen_total }}</b>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fabricante: </label>
                            <b class="col-sm-3 col-form-label">{{ $orden->medidor_actual_fabricante }}</b>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Modelo: </label>
                            <b class="col-sm-3 col-form-label">{{ $orden->medidor_anterior_modelo }}</b>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        


    </div>
@endsection

@section('js')
@endsection
