<template>
    <div class="container-fluid">
        <div class="row">
            <div
                class="col-md-6"
                v-for="(hotel, index) in variables.hotels"
                :key="index"
            >
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-2">{{ hotel.name }}</h4>
                        <h6 class="card-subtitle font-14 text-muted"></h6>
                    </div>
                    <img
                        :src="hotel.url?.full_path ?? getAvatar(hotel.name)"
                        alt=""
                        class="img-fluid d-block image-zoom"
                    />
                    <div class="card-body">
                        <p class="card-text">{{ hotel.address }}</p>
                    </div>
                    <div class="card-footer">
                        <!-- details button -->
                        <btn-option
                            :btnRoute="route('hotels.show', hotel.id)"
                            type="button"
                            color="primary"
                            text="Detalles"
                            icon="ri-eye-fill"
                            v-if="can('hotels.get')"
                        ></btn-option>
                        <!-- edit button  -->
                        <btn-option
                            :action="{
                                id: 'hotels',
                                method: 'edit',
                                params: { id: hotel.id },
                            }"
                            type="button"
                            color="success"
                            text="Editar"
                            icon="ri-image-edit-line"
                            v-if="can('hotels.update')"
                        ></btn-option>
                        <!-- delete button  -->
                        <btn-option
                            :action="{
                                id: 'hotels',
                                method: 'destroy',
                                params: { id: hotel.id },
                            }"
                            type="button"
                            color="danger"
                            text="Eliminar"
                            icon="ri-delete-bin-5-fill"
                            v-if="can('hotels.destroy')"
                        ></btn-option>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hotels-add-edit />
</template>

<script>
import BasicTable from "@/Components/BasicTable.vue";
import BtnOption from "@/Components/BtnOption.vue";
import HotelsAddEdit from "@/Components/Hotels/HotelsAddEdit.vue";

export default {
    components: {
        BasicTable,
        BtnOption,
        HotelsAddEdit,
    },
    props: {
        variables: Object,
    },
    setup(props) {},
};
</script>
