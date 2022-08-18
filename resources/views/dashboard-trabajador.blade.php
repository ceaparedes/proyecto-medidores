@extends('layouts.app')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{($ordenes) ? 'Ordenes de Trabajo Asignadas' : 'Sin Reportes'}}</h1>

</div>
<div class="row">
    @foreach($ordenes as $ord)
    <div class="col-lg-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{$ord->codigo}}</h6>
            </div>
            <div class="card-body">
                <p>N° Servicio: {{$ord->servicio}}</p>
                <p>Nombre Cliente: {{$ord->nombre_cliente}}</p>
                <p>Direccion Cliente: {{$ord->direccion_cliente}}</p>
                <p>Comuna: {{$ord->comunas->nombre}}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection