<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div>
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless">
                                    <tbody>
                                        <tr>
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="ri-user-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Nombre :</p>
                                                    <h6 class="text-truncate mb-0"> {{ variables.__data.contact.client.name
                                                        || 'Sin info' }}</h6>
                                                </div>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="ri-mail-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Correo electronico :</p>
                                                    <h6 class="text-truncate mb-0"> {{ variables.__data.contact.client.email
                                                        || 'Sin info' }}</h6>
                                                </div>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="ri-phone-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Teléfono :</p>
                                                    <h6 class="text-truncate mb-0"> {{ variables.__data.contact.client.phone_number
                                                        || 'Sin info' }}</h6>
                                                </div>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="ri-building-2-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">País :</p>
                                                    <h6 class="text-truncate mb-0"> {{ variables.__data.contact.client.country_id
                                                        || 'Sin info' }}</h6>
                                                </div>
                                            </div>
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
            <div class="col-xxl-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" role="tab">
                                    <i class="fas fa-home"></i> Detalles
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Mensaje</h5>
                        <p>
                            <td>{{ variables.__data.contact.message }}</td>
                        </p>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                            <i class="ri-hotel-line"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="mb-1">Hotel :</p>
                                        <h6 class="text-truncate mb-0"></h6>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-md-4">
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                            <i class="ri-calendar-event-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="mb-1">Fecha Y Hora :</p>
                                        <a href="#" class="fw-semibold">
                                            <p>{{ DateAndTime(variables.__data.contact.created_at) }}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-md-4">
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                            <i class="ri-error-warning-line"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="mb-1">Estado :</p>
                                        <a href="#" class="fw-semibold">{{ variables.__data.contact.status }}</a>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div><!-- end card -->
            </div>
        </div>
    </div>
</template>
  
<script>

export default {
    components: {},
    props: {
        variables: Object,
    },
    methods: {
        DateAndTime(dateTimeString) {
            if (dateTimeString) {
                const date = new Date(dateTimeString);
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                const seconds = String(date.getSeconds()).padStart(2, '0');

                return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            }
            return '';
        },

    },
    computed: {},
};
</script>

  