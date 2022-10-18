@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Perfil</h1>
    </div>

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="col-lg-8">
                <form action="{{route('process-edit-profile', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text"  class="form-control" id="nombre" name="nombre" value="{{$user->name}}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"  class="form-control" id="email" name="email" maxlength="100" value="{{$user->email}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text"  class="form-control" id="username" name="username" value="{{$user->email}}">
                    </div>

                   
                    @if($user->empresa_id)
                    <div class="form-group" id="empresa-content" style="display: none">
                        <label for="empresa">Empresa</label>
                        <input type="text"  class="form-control" id="empresa" name="empresa" value="{{$user->empresas->id}}" readonly>
                    </div>
                    @endif

                    
                    <div class="form-group">
                        <label for="password-old">Contraseña actual</label>
                        <input type="password"  class="form-control" id="password-old" name="password-old" maxlength="100">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña nueva</label>
                        <input type="password"  class="form-control" id="password" name="password" maxlength="100">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <input type="password"  class="form-control" id="password_confirmation" name="password_confirmation" maxlength="100">
                    </div>
                   
                    <div>
                        <a href="{{route('dashboard')}}" class="btn btn-secondary">Volver</a>
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