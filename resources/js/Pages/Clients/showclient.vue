<template>
    <div class="container-fluid">
        <div class="profile-foreground position-relative mx-n2 mt-n2">
            <div class="profile-wid-bg">

            </div>
        </div>
        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
            <div class="row g-4">
                <div class="col-auto">
                    <div class="avatar-lg">

                        <div class="initials-circle rounded-circle "
                            style="width: 100px; height: 100px; background-color: #507dad; display: flex; justify-content: center; align-items: center; font-size: 24px; color: #ffffff; text-transform: uppercase;">
                            {{ getInitials(clients.name) }}
                        </div>

                    </div>
                </div>
                <!--end col-->
                <div class="col">
                    <div class="p-2">
                        <h3 class="text-white mb-1">{{ clients.name }}</h3>
                        <div class="hstack text-white-50 gap-1">
                            <div class="me-1">Correo :</div>
                            {{ clients.email }}
                        </div>
                        <div class="hstack text-white-50 gap-1">
                            <div class="me-1">Numero de teléfono :</div>
                            {{ clients.phone_number }}
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="d-flex">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Overview</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab">
                                    <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Documents</span>
                                </a>
                            </li>
                        </ul>
                        <btn-option :action="{ id: 'clients', method: 'edit', params: { id: clients.id } }"
                        type="button" color="success" text="Editar foto" icon="ri-image-edit-line"
                            v-if="(can('clients.update'))"></btn-option>
                            
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content pt-4 text-muted">
                        <div class="tab-pane active" id="overview-tab" role="tabpanel">
                            <div class="row">
                                <div class="col-xxl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Información</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <th class="ps-0">Nombre : </th>
                                                            <td class="text-muted">{{ clients.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0">Telefono :</th>
                                                            <td class="text-muted">{{ clients.phone_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0">Correo :</th>
                                                            <td class="text-muted">{{ clients.email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0">Ciudad :</th>
                                                            <td class="text-muted">{{ variables.client.country.name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0">Día de ingreso</th>
                                                            <td class="text-muted">{{ formatDate(clients.created_at) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->


                                </div>
                                <!--end col-->
                                <div class="col-xxl-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">About</h5>
                                            <p>Hi I'm Anna Adame, It will be as simple as Occidental; in fact, it will be
                                                Occidental. To an English person, it will seem like simplified English, as a
                                                skeptical Cambridge friend of mine told me what Occidental is European
                                                languages are members of the same family.</p>
                                            <p>You always want to make sure that your fonts work well together and try to
                                                limit the number of fonts you use to three or less. Experiment and play
                                                around with the fonts that you already have in the software you’re working
                                                with reputable font websites. This may be the most commonly encountered tip
                                                I received from the designers I spoke with. They highly encourage that you
                                                use different fonts in one design, but do not over-exaggerate and go
                                                overboard.</p>
                                          
                                        </div>
                                        <!--end card-body-->
                                    </div><!-- end card -->

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header align-items-center d-flex">
                                                    <h4 class="card-title mb-0  me-2">Ultimas reservaciones</h4>
                                                    <div class="flex-shrink-0 ms-auto">
                                                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                                            role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-bs-toggle="tab"
                                                                    href="#today" role="tab">
                                                                    Today
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content text-muted">
                                                        <div class="tab-pane active" id="today" role="tabpanel">
                                                            <div class="profile-timeline">
                                                                <div class="accordion accordion-flush" id="todayExample">
                                                                    <div class="accordion-item border-0">
                                                                        <div class="accordion-header" id="headingOne">
                                                                            <a class="accordion-button p-2 shadow-none"
                                                                                data-bs-toggle="collapse"
                                                                                href="#collapseOne" aria-expanded="true">
                                                                                <div class="d-flex">
                                                                                    <div class="flex-shrink-0">
                                                                                        <img src="assets/images/users/avatar-2.jpg"
                                                                                            alt=""
                                                                                            class="avatar-xs rounded-circle" />
                                                                                    </div>
                                                                                    <div class="flex-grow-1 ms-3">
                                                                                        <h6 class="fs-14 mb-1">
                                                                                            Jacqueline Steve
                                                                                        </h6>
                                                                                        <small class="text-muted">We has
                                                                                            changed 2 attributes on
                                                                                            05:16PM</small>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div id="collapseOne"
                                                                            class="accordion-collapse collapse show"
                                                                            aria-labelledby="headingOne"
                                                                            data-bs-parent="#accordionExample">
                                                                            <div class="accordion-body ms-2 ps-5">
                                                                                In an awareness campaign, it is vital for
                                                                                people to begin put 2 and 2 together and
                                                                                begin to recognize your cause. Too much or
                                                                                too little spacing, as in the example below,
                                                                                can make things unpleasant for the reader.
                                                                                The goal is to make your text as comfortable
                                                                                to read as possible. A wonderful serenity
                                                                                has taken possession of my entire soul, like
                                                                                these sweet mornings of spring which I enjoy
                                                                                with my whole heart.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                              
                                                                    <div class="accordion-item border-0">
                                                                        <div class="accordion-header" id="headingFour">
                                                                            <a class="accordion-button p-2 shadow-none"
                                                                                data-bs-toggle="collapse"
                                                                                href="#collapseFour" aria-expanded="true">
                                                                                <div class="d-flex">
                                                                                    <div class="flex-shrink-0 avatar-xs">
                                                                                        <div
                                                                                            class="avatar-title bg-light text-muted rounded-circle">
                                                                                            <i class="ri-user-3-fill"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="flex-grow-1 ms-3">
                                                                                        <h6 class="fs-14 mb-1">
                                                                                            Nancy Martino
                                                                                        </h6>
                                                                                        <small class="text-muted">Commented
                                                                                            on 12:57PM</small>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div id="collapseFour"
                                                                            class="accordion-collapse collapse show"
                                                                            aria-labelledby="headingFour"
                                                                            data-bs-parent="#accordionExample">
                                                                            <div
                                                                                class="accordion-body ms-2 ps-5 fst-italic">
                                                                                " A wonderful serenity has
                                                                                taken possession of my
                                                                                entire soul, like these
                                                                                sweet mornings of spring
                                                                                which I enjoy with my whole
                                                                                heart. Each design is a new,
                                                                                unique piece of art birthed
                                                                                into this world, and while
                                                                                you have the opportunity to
                                                                                be creative and make your
                                                                                own style choices. "
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            
                                                                </div>
                                                                <!--end accordion-->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <div class="tab-pane fade" id="documents" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h5 class="card-title flex-grow-1 mb-0">Documents</h5>
                                        <div class="flex-shrink-0">
                                            <input class="form-control d-none" type="file" id="formFile">
                                            <label for="formFile" class="btn btn-danger"><i
                                                    class="ri-upload-2-fill me-1 align-bottom"></i> Upload File</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-borderless align-middle mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th scope="col">File Name</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Size</th>
                                                            <th scope="col">Upload Date</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-soft-primary text-primary rounded fs-20">
                                                                            <i class="ri-file-zip-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0)">Artboard-documents.zip</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>Zip File</td>
                                                            <td>4.57 MB</td>
                                                            <td>12 Dec 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink15" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink15">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                        </li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                                            <i class="ri-file-pdf-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0);">Bank Management
                                                                                System</a></h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>PDF File</td>
                                                            <td>8.89 MB</td>
                                                            <td>24 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink3" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink3">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                        </li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-soft-secondary text-secondary rounded fs-20">
                                                                            <i class="ri-video-line"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0);">Tour-video.mp4</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>MP4 File</td>
                                                            <td>14.62 MB</td>
                                                            <td>19 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink4" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink4">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                        </li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-soft-success text-success rounded fs-20">
                                                                            <i class="ri-file-excel-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0);">Account-statement.xsl</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>XSL File</td>
                                                            <td>2.38 KB</td>
                                                            <td>14 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink5" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink5">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                        </li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-soft-info text-info rounded fs-20">
                                                                            <i class="ri-folder-line"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0);">Project
                                                                                Screenshots Collection</a></h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>Floder File</td>
                                                            <td>87.24 MB</td>
                                                            <td>08 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink6" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink6">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                                            <i class="ri-image-2-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0">
                                                                            <a
                                                                                href="javascript:void(0);">Velzon-logo.png</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>PNG File</td>
                                                            <td>879 KB</td>
                                                            <td>02 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink7" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink7">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="text-center mt-3">
                                                <a href="javascript:void(0);" class="text-success"><i
                                                        class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load
                                                    more </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end tab-pane-->
                    </div>
                    <!--end tab-content-->
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div><!-- container-fluid -->
    <clients-add-edit :countries = "variables.countries"/>
</template>

<script>
import BtnOption from '@/Components/BtnOption.vue'
import ClientsAddEdit from '@/Components/Clients/ClientsAddEdit.vue'
export default {
    components: {
        BtnOption,
        ClientsAddEdit
    },
    methods: {
        getInitials(name) {
            const names = name.split(' ');
            return names.map((n) => n[0]).join('').toUpperCase();
        },
        formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }

    },
    props: {
        variables: Object,
    },
    setup(props) {
        const clients = props.variables.client;
        return {
            clients,
        }
    },
};
</script>
