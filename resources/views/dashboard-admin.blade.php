@extends('layouts.app')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bienvenido {{Auth::user()->name}}</h1>
    
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