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
            <div class="col-md-8 col-sm-12">
                <div class="d-flex">
                    <!-- Widget -->
                    <div class="col-xl-6 col-md-12 mx-2">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Reservación</p>
                                    </div>
                                    
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-secondary text-white rounded fs-3">
                                            <i class="ri-hotel-bed-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h7 class="fs-18 fw-semibold ff-secondary mb-4">Total de reservaciones: {{ hotel.reservations_count }}</h7>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-6 col-md-12 mx-2">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Ingresos</p>
                                    </div>
                                    
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-danger text-white rounded fs-3">
                                            <i class="ri-money-dollar-box-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h7 class="fs-18 fw-semibold ff-secondary mb-4">Total de Ingresos: ${{ hotel.reservations_sum_amount }}</h7>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <!-- End Widget -->
                </div>
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
                </div>
            </div>
            
            <!--end col-->
            <!-- Tables -->
            <basic-table
            :data="hotel.clients"
            :tableHeaders="[
                {
                    title: 'Nombre',
                    key: 'name',
                },
                {    
                    title: 'Correo',
                    key: 'email',
                },
                {    
                    title: 'Teléfono',
                    key: 'phone_number',
                },
            ]"
            table_id="clientsTable"
            moduleName="clients"
            detailsBtn :createBtn="false"
        >
            <template #name="element">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar-sm bg-light rounded p-1" style="overflow: hidden;">
                            <img :src="element.cover?.full_path ?? getAvatar(element.name)" 
                            alt="" class="img-fluid d-block">
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fs-14 mb-1">
                            {{ element.name }}
                        </h5>
                        <p class="text-muted mb-0" 
                            v-if="element"
                        >
                           {{ element.slug }}
                        </p>
                    </div>
                </div>
            </template>
            <template #address="element">
                <div 
                    style="
                        word-wrap: break-word;
                        min-width: 160px;
                        max-width: 160px;
                        white-space:normal;
                    "
                >
                    {{ element.address }}
                </div>
            </template>
        </basic-table>


        <basic-table
        :data="hotel.reservations"
        :tableHeaders="[

            {
                title: 'Cliente',
                key: 'clients.name',
            },
            {
                title: 'Costo',
                key: 'amount',
            },
            {    
                title: 'Cantidad de Personas',
                key: 'amount_of_people',
            },
            {    
                title: 'Estado',
                key: 'status',
            },
        ]"
        table_id="clientsTable"
        moduleName="clients"
        detailsBtn :createBtn="false"
    >
        <template #name="element">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar-sm bg-light rounded p-1" style="overflow: hidden;">
                        <img :src="element.cover?.full_path ?? getAvatar(element.name)" 
                        alt="" class="img-fluid d-block">
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="fs-14 mb-1">
                        {{ element.name }}
                    </h5>
                    <p class="text-muted mb-0" 
                        v-if="element"
                    >
                       {{ element.slug }}
                    </p>
                </div>
            </div>
        </template>
        <template #address="element">
            <div 
                style="
                    word-wrap: break-word;
                    min-width: 160px;
                    max-width: 160px;
                    white-space:normal;
                "
            >
                {{ element.address }}
            </div>
        </template>
    </basic-table>
    
        </div>
        <!--end row-->
    </div>
</template>
  
<script>
import BasicTable from '@/Components/BasicTable.vue'
export default {
    components: {
        BasicTable,
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

  