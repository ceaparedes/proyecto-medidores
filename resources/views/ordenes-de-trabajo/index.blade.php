@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatables/datatables.min.css')}}" />
@endsection

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mantenedor Ordenes de trabajo</h1>
        <a href="{{route('ordenes-de-trabajo.import')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Importar Ordenes de Trabajo</a>
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
                            <td>{{($ord->users) ? $ord->users->name : 'Sin trabajador asignado'}}</td>
                            <td>
                                <!-- <a href="">Editar</a> -->
                                <a class="open-modal btn btn-primary" rel="{{$ord->id}}" >{{($ord->users) ? 'Reasignar' : 'Asignar' }}</a>
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
<!-- Modal -->
<div class="modal fade" id="asignacionModal" tabindex="-1" role="dialog" aria-labelledby="asignacionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asignacionModalLabel">Asignación de Medidores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('ordenes-de-trabajo.process-asignar-orden')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selector-trabajadores">Example select</label>
                        <select class="form-control" id="selector-trabajadores" name="trabajador">
                            <option value="">Seleccione un Trabajador</option>
                            @foreach($trabajadores as $tr)
                            <option value="{{$tr->id}}">{{$tr->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="orden" id="orden">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </div>
            </form>
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