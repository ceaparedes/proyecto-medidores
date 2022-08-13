@extends('layouts.guest')
@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">¿Olvidaste tu Contraseña?</h1>
                                <p class="mb-4">Si no recuerdas tu contraseña, por favor escribe tu correo para que nosotros te enviemos una nueva</p>
                            </div>
                            <form class="user">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ingresa tu email....">
                                </div>
                                <a href="login.html" class="btn btn-primary btn-user btn-block">
                                    Cambiar Contraseña
                                </a>
                            </form>
                            <hr>
                           
                            <div class="text-center">
                                <a class="small" href="login.html">Volver a inicio de sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection