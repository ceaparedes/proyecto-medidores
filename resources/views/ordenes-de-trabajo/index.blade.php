@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatables/datatables.min.css')}}"/>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('vendor/datatables/datatables.min.js')}}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#dataTable').DataTable( {
        language: {
            url: '{{asset("vendor/datatables/language/esEs.json")}}'
        }
    } );
});
</script>

 

@endsection

@section('content')
<div class="container-fluid">
      
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Mantenedor Ordenes de trabajo</h1>
                        <a href="{{route('ordenes-de-trabajo-import')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Importar Ordenes de Trabajo</a>
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
                                            <th>codigo</th>
                                            <th>ruta</th>
                                            <th>Nombre cliente</th>
                                            <th>Direccion cliente</th>
                                            <th>comuna</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Número servicio</th>
                                            <th>codigo</th>
                                            <th>ruta</th>
                                            <th>nombre cliente</th>
                                            <th>direccion cliente</th>
                                            <th>comuna</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($ordenes as $ord)
                                            <tr>
                                                <td>{{$ord->servicio}}</td>
                                                <td>{{$ord->codigo}}</td>
                                                <td>{{$ord->ruta}}</td>
                                                <td>{{$ord->nombre_cliente}}</td>
                                                <td>{{$ord->direccion_cliente}}</td>
                                                <td>{{$ord->comunas->nombre}}</td>
                                                <td>
                                                    <a href="">Editar</a>
                                                    <a href="">Asignar</a>
                                                    <a href="">Eliminar</a>
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