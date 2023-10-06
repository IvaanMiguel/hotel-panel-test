<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div>
                            <div class="flex-shrink-0 avatar-md mx-auto">
                                <div class="avatar-title bg-light rounded">
                                    <img :src="variables.url?.full_path ?? getAvatar(rooms.name)" alt=""
                                        class="img-fluid d-block image-zoom">
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <h5 class="mb-1">{{ rooms.name }}</h5>
                                <p class="text-muted text-justify">{{ rooms.slug }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-8">
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                            <i class="ri-hotel-line"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="mb-1">Hotel :</p>
                                        <h6 class="text-truncate mb-0">{{ rooms.hotel? rooms.hotel : 'No encontrado' }}</h6>
                                    </div>
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
                        <h5 class="card-title mb-3">{{ rooms.name }}</h5>
                        <p>
                            <td>{{ rooms.description }}</td>
                        </p>
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
        variables: Object,
    },
    computed: {


    },
    setup(props) {
        const rooms = props.variables.room;
        return {
            rooms,
        }
    }
};
</script>
<style></style>