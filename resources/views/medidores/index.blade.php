@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatables/datatables.min.css')}}" />
@endsection


@section('content')



<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mantenedor Medidores</h1>
        <a href="{{route('medidores.import')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Importar Medidores</a>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Diametro</th>
                            <th>Marca</th>
                            <th>Año</th>
                            <th>Fecha Registro</th>
                            <th>Tuerca</th>
                            <th>Varales</th>
                            <th>Trabajador</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Número</th>
                            <th>Diametro</th>
                            <th>Marca</th>
                            <th>Año</th>
                            <th>Fecha Registro</th>
                            <th>Tuerca</th>
                            <th>Varales</th>
                            <th>Trabajador</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($medidores as $med)
                        <tr>
                            <td>{{$med->numero}}</td>
                            <td>{{$med->diametro}}</td>
                            <td>{{$med->marcas->nombre}}</td>
                            <td>{{$med->ano}}</td>
                            <td>{{$med->fecha_registro}}</td>
                            <td>{{$med->tuerca}}</td>
                            <td>{{$med->varal}}</td>
                            <td>{{($med->users) ? $med->users->name : 'Sin trabajador asignado'}}</td>
                            <td>{{($med->estado) ? 'Activo' : 'inactivo'}}</td>
                            <td>
                                <!-- <a href="">Editar</a> -->
                                <a class="open-modal btn btn-primary" rel="{{$med->id}}">{{($med->users) ? 'Reasignar' : 'Asignar' }}</a>
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
            <form action="{{route('medidores.process-asignar-medidor')}}" method="post">
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
                        <input type="hidden" name="medidor" id="medidor">
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
        $('#medidor').val($(this).attr('rel'));
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
     swal ( "Ups" , errors, "error" )
</script>
@endif

@endsection