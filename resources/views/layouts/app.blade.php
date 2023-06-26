<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="enable">

<head>
    <x-head>
        @if (isset($head))
            {{ $head }}
        @endif     
    </x-head>   
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!--Navbar-->
        <x-navbar></x-navbar>

        <!-- ========== Sidebar ========== -->
        <x-sidebar></x-sidebar>

        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div id="{{$vueActive}}">

                        <!-- Breadcrumb -->
                        <x-breadcrumb
                            :breadcrumb="$breadcrumb"
                        ></x-breadcrumb>

                        @if(session()->has('success'))
                        <x-status-alert color="success" status="Hecho" 
                            mensaje="Proceso completado correctamente."
                            icono="ri-check-double-line"
                        ></x-status-alert>
                        @endif
                        @if(session()->has('error'))
                        <x-status-alert color="danger" status="Error"
                            mensaje="El proceso no pudo ser completado correctamente."
                            icono="ri-error-warning-line"
                        ></x-status-alert>
                        @endif

                        {{ $slot }}
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <!--Footer-->
            <x-footer></x-footer>

        </div>
        <!-- end main content-->

    </div>
    
    <!--Scripts-->
    <x-scripts>
        @if (isset($scripts))
            {{ $scripts }}
        @endif     
    </x-scripts>   
</body>

</html>