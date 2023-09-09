<template>
    <basic-table
        :data="variables.contacts"
        :tableHeaders="[
            {
                title: 'Nombre',
                key: 'name',
            },
            
        ]"
        table_id="contactsTable"
        moduleName="contacts"
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
                v-if="can('contacts.get')"
            ></btn-option>
        </template>
    </basic-table>

    <contacts-add-edit />
</template>

<script>
import BasicTable from '@/Components/BasicTable.vue'
import BtnOption from '@/Components/BtnOption.vue'
export default {
    components: {
        BasicTable,
        BtnOption,
    },
    props:{
        variables: Object,
    },
    setup(props){
    }
}
</script>