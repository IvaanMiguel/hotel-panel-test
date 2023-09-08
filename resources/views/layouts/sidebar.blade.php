<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-new.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-new.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-new.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-new.png') }}" alt="" height="48">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home')}}" role="button">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->hasPermissionTo('hotels.get'))
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('hotels*') ? 'active' : '' }}" href="{{ route('hotels')}}" role="button">
                        <i class="ri-building-4-line"></i> <span>Hoteles</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->hasPermissionTo('users.get'))
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users')}}" role="button">
                        <i class="ri-building-4-line"></i> <span>Usuarios</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->hasPermissionTo('clients.get'))
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('clients*') ? 'active' : '' }}" href="{{ route('clients')}}" role="button">
                        <i class="ri-building-4-line"></i> <span>Clientes</span>
                    </a>
                </li>
                @endif
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('logout')}}" role="button">
                            @csrf
                            <i class="ri-logout-box-r-line"></i> 
                            <span>Cerrar Sesion</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>

<script>
            function submitForm() {
                let form = document.getElementById("logoutForm");

                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "Se cerrará la sesión.",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        </script>

        <!-- Left Sidebar End -->