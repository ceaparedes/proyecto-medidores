@extends('layouts.app')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{($ordenes->count()) ? 'Ordenes de Trabajo Asignadas' : 'Sin Reportes'}}</h1>

</div>
<div class="row">
    @foreach($ordenes as $ord)
    <div class="col-lg-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{$ord->servicio}}</h6>
            </div>
            <div class="card-body">
                <p>Ruta: {{$ord->ruta}}</p>
                <p>Nombre Cliente: {{$ord->nombre_cliente}}</p>
                <p>Direccion Cliente: {{$ord->direccion_cliente}}</p>
                <p>Comuna: {{$ord->comunas->nombre}}</p>
                @if($medidores)
                    <a href="{{asset('/archivos/hoja_cambio_medidor.docx')}}" class="btn btn-primary">Descargar Hoja cambio Medidor</a>
                    <a href="{{route('instalaciones.index', $ord->id)}}" class="btn btn-primary">Instalar</a>


                @else
                    <span class="alert alert-warning">Debe tener medidores asignados para poder realizar una instalación</span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection


@section('js')


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