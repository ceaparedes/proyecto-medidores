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
        <form action="" method="">
            <div class="card shadow mb-4" id="cambio-1">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lectura de retiro</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="lectura-retiro">Lectura de Retiro</label>
                        <input type="text"class="form-control" id="lectura-retiro" name="lectura_retiro">
                    </div>

                    <div class="form-group">
                        <label for="image-1">
                            <img src="{{ asset('/img/default-image.png') }}" alt="imagen-cambio-1" class="img-thumbnail"
                                id="preview-image-1" width="200px" heigth="200px"></label>
                        <input type="hidden" name="path_imagen[]" id="path-imagen-1">
                        <input type="file" class="img_file" name="imagen[]" id="image-1" style="display:none"
                            rel="1">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary">Continuar</button>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4" id="cambio-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos de Nuevo Medidor</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="improcedencia">Medidor</label>
                        <select name="improcedencia" id="improcedencia" class="custom-select d-block w-100" required>
                            <option value="" disabled="" selected="">Seleccione</option>
                            @foreach ($medidores as $med)
                                <option value="{{ $med->id }}">{{ $med->marcas->nombre }} - {{ $med->numero }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="informacion-medidores">

                    </div>
                    <p class="card-description">
                        Foto de medidor instalado
                    </p>
                    <div class="form-group">
                        <label for="image-2">
                            <img src="{{ asset('/img/default-image.png') }}" alt="imagen-improcedencia"
                                class="img-thumbnail" id="preview-image-2" width="200px" heigth="200px"></label>
                        <input type="hidden" name="path_imagen[]" id="path-imagen-2">
                        <input type="file" class="img_file" name="imagen[]" id="image-2" style="display:none"
                            rel="2">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary">Continuar</button>
                    </div>
                </div>

            </div>

            <div class="card shadow mb-4" id="cambio-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cambio de Varales y Datos del Cliente</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="varales">Varales</label>
                        <select name="varales" id="varales"  class="custom-select d-block w-100" required>
                          <option value="" disabled="" selected="">Seleccione</option>
                            <option value="Sin cambio">Sin cambio</option>
                            <option value="Entrada">Entrada</option>
                            <option value="Salida">Salida</option>
                            <option value="Ambos">Ambos</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="observaciones">Observaciones (opcional)</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4"></textarea>
                      </div> 

                    <div class="form-group">

                    <label for="image-3">
                        <img src="{{asset('/img/default-image.png')}}" alt="imagen-improcedencia"class="img-thumbnail" id="preview-image-3" width="200px" heigth="200px"></label>
                        <input type="hidden" name="path_imagen[]" id="path-imagen-3">
                    <input type="file" class="img_file" name="imagen[]" id="image-3" style="display:none" rel="3">
                    </div>

                    <div class="form-group">
                        <label for="observaciones">Nombre cliente</label>
                        <input type="text" name="nombre_cliente" id="nombre-cliente" class="form-control">
                      </div> 

                      <div class="form-group">
                        <label for="observaciones">Rut cliente</label>
                        <input type="text" name="rut_cliente" id="rut-cliente" class="form-control">
                      </div> 

                    <div class="form-group">
                        <button type="button" class="btn btn-primary">Continuar</button>
                    </div>

                </div>


            </div>

            <div class="card shadow mb-4" id="cambio-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Orden de Cambio</h6>
                </div>
                <div class="card-body">
                    <p class="card-description">
                        Suba una foto de la orden de cambio
                      </p>
                    <div class="form-group">
                        <label for="image-4">
                            <img src="{{asset('/img/default-image.png')}}" alt="imagen-improcedencia"class="img-thumbnail" id="preview-image-4" width="200px" heigth="200px"></label>
                            <input type="hidden" name="path_imagen[]" id="path-imagen-4">
                        <input type="file" class="img_file" name="imagen[]" id="image-4" style="display:none" rel="4">
                      </div>

                      <div class="form-group">
                        <button type="button" class="btn btn-primary">Continuar</button>
                    </div>

                </div>

            </div>

        </form>


    </div>
@endsection

@section('js')
@endsection
