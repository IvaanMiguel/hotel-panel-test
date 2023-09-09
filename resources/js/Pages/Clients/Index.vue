<template>
    <basic-table-new
        :data="variables.clients"
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
        detailsBtn
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
        <template #tableActions="element">
            <btn-option
                :btnRoute="element.url_address"
                type="listButton"
                color="info"
                text="Url de dirección"
                icon="ri-map-pin-2-fill"
                v-if="can('clients.get')"
            ></btn-option>
        </template>
    </basic-table-new>

    <clients-add-edit />
</template>

<script>
import BasicTableNew from '@/Components/BasicTableNew.vue'
import BtnOption from '@/Components/BtnOption.vue'
import ClientsAddEdit from '@/Components/Clients/ClientsAddEdit.vue'
export default {
    components: {
        BasicTableNew,
        BtnOption,
        ClientsAddEdit,
    },
    props:{
        variables: Object,
    },
    setup(props){
    }
}
</script>