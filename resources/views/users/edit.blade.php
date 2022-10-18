@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Crear Nueva Empresa</h1>
    </div>

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="col-lg-8">
                <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text"  class="form-control" id="nombre" name="nombre" value="{{$user->nombre}}">
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email"  class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text"  class="form-control" id="username" name="username" value="{{$user->username}}">
                    </div>

                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select name="rol" id="rol" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach($roles as $rol)
                                <option value="{{$rol->id}}" {{($rol->id == $user->role->id) ? }}>{{$rol->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    
                    <div class="form-group" id="empresa-content">
                        @if($user->role->id == 3)
                            <label for="empresa">Empresa</label>
                            <select name="empresa" id="empresa" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach($empresas as $emp)
                                    <option value="{{$emp->id}}" {{($emp->id == $user->empresa_id) ? }}>{{$emp->nombre}}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="1" {{($user->estado == 1) ? 'selected' : ''}}>Activo</option>
                            <option value="0" {{($user->estado == 0) ? 'selected' : ''}}>Inactivo</option>
                        </select>
                    </div>

                    <div>
                        <a href="{{route('users.index')}}" class="btn btn-secondary">Volver</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js') 
@if ($errors->any())
<script>
    
     let errors = `@foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach`;
     swal ( "Ups" , errors, "error" )
                                        
  

</script>  
@endif
@endsection