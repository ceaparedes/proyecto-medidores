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
            <h6 class="collapse-header">Opciones:</h6>
            <a class="collapse-item {{(\Request::segment(1) == 'ordenes-de-trabajo') ? 'active' : ''}}" href="{{route('ordenes-de-trabajo.index')}}"  >Ordenes de Trabajo</a>
            <a class="collapse-item {{(\Request::segment(1) == 'medidores') ? 'active' : ''}}" href="{{route('medidores.index')}}">Medidores</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
        </div>
    </div>
</li> -->

<!-- Divider -->
<!-- <hr class="sidebar-divider">

<div class="sidebar-heading">
    Addons
</div>

 Nav Item - Pages Collapse Menu 
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
    </div>
</li> -->

<!-- Nav Item - Charts -->
<!-- <li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a>
</li> -->



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
@endif
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
<!-- End of Sidebar -->