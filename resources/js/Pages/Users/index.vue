<template>
    <basic-table :data="variables.users" :tableHeaders="[
        {
            title: 'Nombre',
            key: 'name',
        },
        {
            title:'rol',
           key:'role_id'
        },
        {
            title: 'Correo',
            key: 'email',
        },
        {
            title:'hotel',
            key:'hotel_id'
        }

    ]" table_id="usersTable" moduleName="users" detailsBtn :createBtnpermissions="true">
        <template #name="element">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar-sm bg-light rounded p-1" style="overflow: hidden;">
                        <img :src="element.avatar_path || getAvatar(element.name)" alt="" class="img-fluid d-block">
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="fs-14 mb-1">
                        {{ element.name }}
                    </h5>
                    <p class="text-muted mb-0" v-if="element">
                        {{ element.slug }}
                    </p>
                </div>
            </div>
        </template>
        <template #address="element">
            <div style="
                    word-wrap: break-word;
                    min-width: 160px;
                    max-width: 160px;
                    white-space:normal;
                ">
                {{ element.address }}
            </div>
        </template>
    </basic-table>
    <!-- :roles = "variables.roles" -->
    <users-add-edit />
</template>

<script>
import BasicTable from '@/Components/BasicTable.vue'
import BtnOption from '@/Components/BtnOption.vue'
import UsersAddEdit from '@/Components/Users/UsersAddEdit.vue'
export default {
    components: {
        BasicTable,
        BtnOption,
        UsersAddEdit,
    },
    props: {
        variables: Object,
    },
    setup(props) {
    }
}
</script>