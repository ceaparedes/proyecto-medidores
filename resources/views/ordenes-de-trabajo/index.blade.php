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
            <button type="button" id="asignacion-multiple-btn" class="btn btn-primary" data-toggle="modal" data-target="#asignacionModalMultiple" style="display: none;">Asignacion multiple</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input select-all" type="checkbox" value="" id="selectAllHead">
                                    <label class="form-check-label" for="selectAllHead">
                                      Seleccionar Todos
                                    </label>
                                  </div>
                            </th>
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
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input select-all" type="checkbox" value="" id="selectAllFoot">
                                    <label class="form-check-label" for="selectAllFoot">
                                      Seleccionar Todos
                                    </label>
                                  </div>
                            </th>
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
                                @if(!$ord->users)
                                <div class="form-check">
                                    <input class="form-check-input orden-check" type="checkbox" value="{{$ord->id}}" id="orden-{{$loop->iteration}}">
                                    <label class="form-check-label" for="orden-{{$loop->iteration}}">
                                        Seleccione
                                    </label>
                                  </div>
                                @endif
                            </td>
                            <td>
                                {{$ord->servicio}} 
                            </td>
                            <td>{{$ord->ruta}}</td>
                            <td>{{$ord->nombre_cliente}}</td>
                            <td>{{$ord->direccion_cliente}}</td>
                            <td>{{$ord->comunas->nombre}}</td>
                            <td>{{($ord->users) ? $ord->users->name : 'Sin trabajador asignado'}}</td>
                            <td>
                                @if($ord->estado == 0)
                                    {{'Orden no realizada'}}
                                @endif
                            </td>
                            <td>
                                <!-- <a href="">Editar</a> -->
                                <a class="open-modal btn btn-primary" rel="{{$ord->id}}" >{{($ord->users) ? 'Reasignar' : 'Asignar' }}</a> 
                                @if($ord->users)
                                    <a href="{{asset('/archivos/hoja_cambio_medidor.docx')}}" class="btn btn-primary">Descargar Hoja cambio Medidor</a>
                                @endif
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


<div class="modal fade bd-example-modal-lg" id="asignacionModalMultiple" tabindex="-2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="asignacionModalLabel">Asignación multiple de Ordenes de Trabajo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('ordenes-de-trabajo.process-multi-asignacion')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="selector-trabajadores">Trabajador</label>
                    <select class="form-control" id="selector-trabajadores" name="trabajador">
                        <option value="">Seleccione un Trabajador</option>
                        @foreach($trabajadores as $tr)
                            <option value="{{$tr->id}}">{{$tr->name}}</option>
                        @endforeach
                    </select>

                    <div id="contenedor-ordenes">
                        
                    </div>
                    
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
            },
            "ordering": false
        });
    });
</script>

<script>
    $(document).on('click', '.open-modal', function() {
        $('#orden').val($(this).attr('rel'));
        $('#asignacionModal').modal('show');

    })
</script>


<script>
    $(document).on('click', '.select-all', function(){
        
        var checkboxes = $('.orden-check')
        checkboxes.prop('checked', $(this).is(':checked'));
        if ($('.orden-check:checked').length > 0) {
            $("#asignacion-multiple-btn").show();
        }else{
            $("#asignacion-multiple-btn").hide();
        }
        
    });

    $('.orden-check').change( function(){
    if ($('.orden-check:checked').length > 0) {
        $("#asignacion-multiple-btn").show();
    }else{
        $("#asignacion-multiple-btn").hide();
    }

    });

    function getValueUsingClass(){
        
        var chkArray = [];
       
        /* Revisa los elementos checkeados por */
        $(".orden-check:checked").each(function() {
            chkArray.push($(this).val());
        });

        if(chkArray.length <= 0){
            swal ( "Ups" , "Debe seleccionar una orden de trabajo", "error" )
            return false;
        }else{
            return chkArray;
        }

    }

    $(document).on('click', '#asignacion-multiple-btn', function(){
        var checkboxes = getValueUsingClass();
        console.log(checkboxes);
        $('#contenedor-ordenes').empty();
        for (let i = 0; i < checkboxes.length; i++) {
            $('#contenedor-ordenes').append(`<input type="hidden" name="ordenes[]" id="orden-seleccionada-${i}" value="${checkboxes[i]}">`);
        }  
        $('#asignacionModalMultiple').modal('show');
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