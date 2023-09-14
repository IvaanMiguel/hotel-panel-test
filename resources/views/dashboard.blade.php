<x-app>
    <x-slot name="head">
        <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    </x-slot>

    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">
                                    @if (date('H:i:s') >= '06:00' && date('H:i:s') <= '12:00' ) Buenos días, @elseif (date('H:i:s')>= '12:00' && date('H:i:s') <= '18:00' ) Buenas tardes, @else Buenas noches, @endif {{Auth::user()->name}}!</h4>
                                            <p class="text-muted mb-0">Datos sobre los servicios..</p>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Hotel con más reservaciones</p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary text-white rounded fs-3">
                                        <i class="ri-hotel-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">(En espera)</h4>
                                        <h6>candidad de reservacines</h6>
                                    </div>
                                   
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">habitación más reservada</p>
                                    </div>
                                    
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-secondary text-white rounded fs-3">
                                        <i class="ri-hotel-bed-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">(En espera)</h4>
                                        <h6>candidad de reservacines</h6>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Ingresos del mes anterior</p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-danger text-white rounded fs-3">
                                        <i class="ri-money-dollar-box-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">(En espera)</h4>
                                        <h6>candidad de ingresos</h6>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Ingreso del año actual</p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title  bg-success text-white rounded fs-3">
                                        <i class="ri-money-dollar-circle-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">(En espera) </h4>
                                        <h6>candidad de ingresos anual</h6>
                                    </div>
                                   
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->


            </div>

        </div> <!-- end col -->
    </div>

</x-app>