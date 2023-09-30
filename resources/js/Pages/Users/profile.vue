<template>
    <!-- <div v-for="(value, key) in variables.user" :key="key">
        <p>{{ key }}: {{ value }}</p>
    </div> -->
    <div class="container-fluid">
            <div class="container-fluid">
                <div class="profile-foreground position-relative mx-n3 mt-n3">
                    <div class="profile-wid-bg">
                    </div>
                </div>
                <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                    <div class="row g-4">
                        <div class="col-auto">
                            <div class="avatar-lg">
                                <template v-if="variables.user.avatar_path">
                                    <img :src="variables.user.avatar_path" alt="user-img"
                                        style="width: 100px; height: 100px; background-color: #507dad; display: flex; justify-content: center; align-items: center;"
                                        class="img-thumbnail rounded-circle user-avatar" />
                                </template>
                                <template v-else>
                                    <div class="initials-circle rounded-circle "
                                        style="width: 100px; height: 100px; background-color: #507dad; display: flex; justify-content: center; align-items: center; font-size: 24px; color: #ffffff; text-transform: uppercase;">
                                        {{ getInitials(variables.user.name) }}
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-2">
                                <h3 class="text-white mb-1">{{ variables.user.name }}</h3>
                                <p class="text-white-75">
                                    Rol: {{ variables.user.role_id === 1 ? 'Sistemas' : (variables.user.role_id === 2 ?
                                        'Administrador' : 'User') }}
                                </p>
                                <p class="text-white-75">Correo: {{ variables.user.email }}</p>
                                <div class="hstack text-white-50 gap-1">
                                    <div>
                                        <i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>Hotel :
                                        {{ variables.user.hotel && variables.user.hotel.name ? variables.user.hotel.name :
                                            'Sin hotel' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="d-flex">
                                <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1"
                                    role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities" role="tab">
                                            <i class="ri-list-unordered d-inline-block d-md-none"></i> <span
                                                class="d-none d-md-inline-block">Actividad</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>


                            <div class="card">
                                <div class="card-body">
                                    <div class="acitivity-timeline">
                                        <div>
                                            <h5>Registros de Actividad</h5>
                                            <div v-for="log in variables.user.logs.data" :key="log.id"
                                                class="acitivity-item py-3 d-flex">
                                                <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                    <div class="avatar-title bg-soft-success text-success rounded-circle">
                                                        {{ log.description.charAt(0) }}
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-group ms-2">
                                                            <a href="javascript: void(0);" class="avatar-group-item"
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                                data-bs-original-title="Usuario">
                                                                <template v-if="variables.user.avatar_path">
                                                                    <img :src="variables.user.avatar_path" alt=""
                                                                        class="rounded-circle avatar-xs" />
                                                                </template>
                                                                <template v-else>
                                                                    <div class="rounded-circle avatar-xs bg-soft-primary text-center text-white"
                                                                        style="line-height: 30px; width: 30px; height: 30px;">
                                                                        {{ getInitials(log.action) }}
                                                                    </div>
                                                                </template>
                                                            </a>
                                                        </div>
                                                        <span class="badge bg-soft-secondary text-secondary align-middle">{{
                                                            log.action }}</span>
                                                    </div>
                                                    <p class="text-muted mb-2"><i
                                                            class="ri-file-text-line align-middle ms-2"></i>{{
                                                                log.description }}</p>
                                                    <small class="mb-0 text-muted">{{ formatDate(log.created_at) }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</template>

<script>
export default {
    components: {
    },
    methods: {
        getInitials(name) {
            const names = name.split(' ');
            return names.map((n) => n[0]).join('').toUpperCase();
        },
        formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }
    },
    props: {
        variables: Object,
    },
    setup(props) {
    }


}
</script>



