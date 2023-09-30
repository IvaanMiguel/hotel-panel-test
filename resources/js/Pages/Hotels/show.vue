<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div>
                            <div class="flex-shrink-0 avatar-md mx-auto">
                                <div class="avatar-title bg-light rounded">
                                    <img :src="hotel.url?.full_path ?? getAvatar(hotel.name)" alt=""
                                        class="img-fluid d-block image-zoom">
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <h5 class="mb-1">{{ hotel.name }}</h5>
                                <p class="text-muted">{{ hotel.address }}</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless">
                                    <tbody>
                                        <tr>
                                            <th><span class="fw-medium">Ubicación</span></th>
                                            <td>
                                                <a :href="correctedUrl" target="_blank" class="link-primary">Ver en el
                                                    mapa</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><span class="fw-medium">Email</span></th>
                                            <td>{{ hotel.email }}</td>
                                        </tr>
                                        <tr>
                                            <th><span class="fw-medium">Contacto</span></th>
                                            <td>{{ hotel.phone_number }}</td>
                                        </tr>
                                        <tr>
                                            <th><span class="fw-medium">Dirección</span></th>
                                            <td>{{ hotel.address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->

            <div class="col-xxl-8">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                        <div>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                ALL
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1M
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                6M
                            </button>
                            <button type="button" class="btn btn-soft-primary btn-sm">
                                1Y
                            </button>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-header p-0 border-0 bg-soft-light">
                        <div class="row g-0 text-center">
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="7585">0</span></h5>
                                    <p class="text-muted mb-0">Orders</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1">$<span class="counter-value" data-target="22.89">0</span>k</h5>
                                    <p class="text-muted mb-0">Earnings</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="367">0</span></h5>
                                    <p class="text-muted mb-0">Refunds</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0 border-end-0">
                                    <h5 class="mb-1 text-success"><span class="counter-value" data-target="18.92">0</span>%
                                    </h5>
                                    <p class="text-muted mb-0">Conversation Ratio</p>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body p-0 pb-2">
                        <div>
                            <div id="customer_impression_charts"
                                data-colors='["--vz-primary", "--vz-success", "--vz-danger"]' class="apex-charts"></div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <div id="table-product-list-all" class="table-card gridjs-border-none"></div>
                    </div>
                </div>

            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</template>
  
<script>

export default {
    components: {

    },
    props: {
        hotel: Object,
    },
    computed: {
        correctedUrl() {
            return this.hotel.url_address.replace(/\\/g, '');
        },
    },
};
</script>

  