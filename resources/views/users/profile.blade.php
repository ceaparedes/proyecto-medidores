@extends('layouts.app')
@section('content')
<form class="user">
    <h1>Editar Perfil</h1>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
        </div>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
        </div>
    </div>
    <div class="form-group">
        <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
        </div>
        <div class="col-sm-6">
            <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
        </div>
    </div>
    <a href="login.html" class="btn btn-primary btn-user btn-block">
        Register Account
    </a>
    <hr>

</form>
@endsection