   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
    <div class="sidebar-brand-icon ">
        <i > <img width="50px" heigth="50px"src="{{asset('/img/marca_vertical_transparente.png')}}" alt="logo"></i>{{-- Cambiar al logo--}}
    </div>
    <div class="sidebar-brand-text mx-3">IngeSistem</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{(\Request::segment(1) == 'dashboard') ? 'active' : ''}}">
    <a class="nav-link" href="{{route('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

@if(Auth::user()->hasRole('Administrador'));
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Administracion
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item ">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Ordenes de trabajo </span>
    </a>
    <div id="collapseTwo" class="collapse {{(\Request::segment(1) == 'ordenes-de-trabajo' || \Request::segment(1) == 'medidores' ) ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Ordenes de Trabajo:</h6>
            <a class="collapse-item {{(\Request::segment(1) == 'ordenes-de-trabajo' && !\Request::segment(2)) ? 'active' : ''}}" href="{{route('ordenes-de-trabajo.index')}}"  >No realizadas</a>
            <a class="collapse-item {{(\Request::segment(1) == 'ordenes-de-trabajo' && \Request::segment(2) == 'listado-improcedencias') ? 'active' : ''}}" href="{{route('ordenes-de-trabajo.listado-improcedencias')}}"  >Improcedencias</a>
            <a class="collapse-item {{(\Request::segment(1) == 'ordenes-de-trabajo' && \Request::segment(2) == 'listado-completadas') ? 'active' : ''}}" href="{{route('ordenes-de-trabajo.listado-completadas')}}"  >Completadas</a>
            <h6 class="collapse-header">Mantenedores:</h6>
            <a class="collapse-item {{(\Request::segment(1) == 'medidores') ? 'active' : ''}}" href="{{route('medidores.index')}}">Medidores</a>
        </div>
    </div>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
@endif
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
<!-- End of Sidebar -->