@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/datatables/datatables.min.css')}}" />
@endsection

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mantenedor Empresas</h1>
        @csrf
        <a href="{{route('users.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Agregar Nuevo Usuario</a>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Nombre de usuario</th>
                            <th>Fecha de Creación</th>
                            <th>Última actualización</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Nombre de usuario</th>
                            <th>Fecha de Creación</th>
                            <th>Última actualización</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $us)
                        <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$us->name}}</td>
                           <td>{{$us->email}}</td>
                           <td>{{$us->username}}</td>
                           <td>{{$us->created_at->format('d-m-Y H:i:s')}}</td>
                           <td>{{$us->updated_at->format('d-m-Y H:i:s')}}</td>
                           <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input cambio-estado" id="cambio-estado-{{$us->id}}" rel="{{ $us->id}}" {{ ($us->estado == 1) ? 'checked' : '' }} >
                                    <label id="label-cambio-estado-{{$us->id}}" class="custom-control-label" for="cambio-estado-{{$us->id}}">{{($us->estado == 1) ? 'Activo' : 'Inactivo' }}</label>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('users.edit', $us->id)}}" class="btn btn-primary">Editar</a>
                                <a rel="{{$us->id}}" rel2="{{$us->nombre}}" class="open-modal btn btn-danger">Eliminar</a>
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
<div class="modal fade" id="EliminarModal" tabindex="-1" role="dialog" aria-labelledby="EliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{(route('users.destroy'))}}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-header">
            <h4 class="modal-title" id="EliminarModalLabel">Eliminar Usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <h5 id="name-user">¿Esta seguro de eliminar al usuario?</h5>
            <input type="hidden" name="user" id="user-eliminar" value="">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
            <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
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
        $('#user-eliminar').val($(this).attr('rel'));
        let name = $(this).attr('rel2')
        $('#name-user').empty();
        $('#name-user').append(`¿Esta seguro de eliminar al Usuario <b>${name}</b>?`);
        $('#EliminarModal').modal('show');

    })
</script>


<script>
    $(document).on('click', '.cambio-estado', function(){
        let usuario = $(this).attr('rel');
        let token = $('input[name="_token"]').val();
        console.log(token);
        $.ajax({
            url:`/usuarios/cambiar-estado/${usuario}`,
            method: 'post',
            data:'',
            datatype:'json',
            headers: {
                'X-CSRF-TOKEN': token ,
            },
            success:function(response){
                $(`#label-cambio-estado-${usuario}`).empty();
                $(`#label-cambio-estado-${usuario}`).append(response.text_label_estado);
            }, 
            error:function(){
                swal("Ups", "Ha ocurrido un error, ", "error")
            }
        });
    });
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