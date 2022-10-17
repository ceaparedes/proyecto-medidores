@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatables/datatables.min.css')}}" />
@endsection

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ordenes de trabajo Completadas</h1>
        <a href="{{route('ordenes-de-trabajo.exportar-ordenes-realizadas')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Exportar Ordenes de Trabajo Realizadas</a>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Número servicio</th>
                            <th>Ruta</th>
                            <th>Nombre cliente</th>
                            <th>Direccion cliente</th>
                            <th>comuna</th>
                            <th>Trabajador Asignado</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Número servicio</th>
                            <th>ruta</th>
                            <th>nombre cliente</th>
                            <th>direccion cliente</th>
                            <th>comuna</th>
                            <th>Trabajador Asignado</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($ordenes as $ord)
                        <tr>
                            <td>
                                {{$ord->servicio}}
                            </td>
                            <td>{{$ord->ruta}}</td>
                            <td>{{$ord->nombre_cliente}}</td>
                            <td>{{$ord->direccion_cliente}}</td>
                            <td>{{$ord->comunas->nombre}}</td>
                            <td>{{($ord->users) ? $ord->users->name : 'Sin trabajador asignado'}}</td>
                            <td>
                                @if($ord->estado == 1)
                                    {{'Cambio Realizado'}}
                                @endif
                            </td>
                            <td>
                                <!-- <a href="">Editar</a> -->
                                <a class="open-modal btn btn-primary" href="{{route('ordenes-de-trabajo.detalle',$ord->id)}}" >Detalle</a>
                                <!-- <a href="">Eliminar</a> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection


@section('js')
<script type="text/javascript" src="{{asset('vendor/datatables/datatables.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#dataTable').DataTable({
            language: {
                url: '{{asset("vendor/datatables/language/esEs.json")}}'
            }
        });
    });
</script>

<script>
    $(document).on('click', '.open-modal', function() {
        $('#orden').val($(this).attr('rel'));
        $('#asignacionModal').modal('show');

    })
</script>



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
    swal("Ups", errors, "error")
</script>
@endif

@endsection