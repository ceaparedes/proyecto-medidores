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
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input select-all" type="checkbox" value="" id="selectAllFoot">
                                    <label class="form-check-label" for="selectAllFoot">
                                        Seleccionar Todos
                                    </label>
                                  </div>
                                
                            </th>
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
                            <td>
                                @if(!$med->users)
                                <div class="form-check">
                                    <input class="form-check-input medidor-check" type="checkbox" value="{{$med->id}}" id="medidor-{{$loop->iteration}}">
                                    <label class="form-check-label" for="medidor-{{$loop->iteration}}">
                                        Seleccione
                                    </label>
                                  </div>
                                @endif
                            </td>
                            <td>{{$med->numero}}</td>
                            <td>{{$med->diametro}}</td>
                            <td>{{$med->marcas->nombre}}</td>
                            <td>{{$med->ano}}</td>
                            <td>{{$med->fecha_registro}}</td>
                            <td>{{$med->tuerca}}</td>
                            <td>{{$med->varal}}</td>
                            <td>{{($med->users) ? $med->users->name : 'Sin trabajador asignado'}}</td>
                            <td>{{($med->estado) ? 'Instalado' : 'no instalado'}}</td>
                            <td>
                                <!-- <a href="">Editar</a> -->
                                @if(!$med->estado)
                                    <a class="open-modal btn btn-primary" rel="{{$med->id}}">{{($med->users) ? 'Reasignar' : 'Asignar' }}</a>
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


<div class="modal fade bd-example-modal-lg" id="asignacionModalMultiple" tabindex="-2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="asignacionModalLabel">Asignación multiple de Medidores</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('medidores.process-multi-asignacion')}}" method="post">
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

                    <div id="contenedor-medidores">
                        
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
        $('#medidor').val($(this).attr('rel'));
        $('#asignacionModal').modal('show');

    })
</script>

<script>
    $(document).on('click', '.select-all', function(){
        
        var checkboxes = $('.medidor-check')
        checkboxes.prop('checked', $(this).is(':checked'));
        if ($('.medidor-check:checked').length > 0) {
            $("#asignacion-multiple-btn").show();
        }else{
            $("#asignacion-multiple-btn").hide();
        }
        
    });

    $('.medidor-check').change( function(){
    if ($('.medidor-check:checked').length > 0) {
        $("#asignacion-multiple-btn").show();
    }else{
        $("#asignacion-multiple-btn").hide();
    }

    });

    function getValueUsingClass(){
        
        var chkArray = [];
       
        /* Revisa los elementos checkeados por */
        $(".medidor-check:checked").each(function() {
            chkArray.push($(this).val());
        });

        if(chkArray.length <= 0){
            swal ( "Ups" , "Debe seleccionar un medidor", "error" )
            return false;
        }else{
            return chkArray;
        }

    }

    $(document).on('click', '#asignacion-multiple-btn', function(){
        var checkboxes = getValueUsingClass();
        console.log(checkboxes);
        $('#contenedor-medidores').empty();
        for (let i = 0; i < checkboxes.length; i++) {
            $('#contenedor-medidores').append(`<input type="hidden" name="medidores[]" id="medidor-seleccionado-${i}" value="${checkboxes[i]}">`);
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
     swal ( "Ups" , errors, "error" )
</script>
@endif

@endsection