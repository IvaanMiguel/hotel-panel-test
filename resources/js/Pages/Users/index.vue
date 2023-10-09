<template>
    <basic-table :data="variables.users" :tableHeaders="[
        {
            title: 'Nombre',
            key: 'name',
        },
        {
            title:'rol',
           key:'role_id',
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
        <template #role_id="element">
            <div v-if=" getRoleNameById(element.role_id) !=' '">
                <span class="badge bg-info"> {{ getRoleNameById(element.role_id) }}</span>
            </div>
            <div v-else>
                {{ getRoleNameById(element.role_id) }}
            </div>
        </template>

        <template #hotel_id="element">
            <div v-if=" getHotelNameById(element.hotel_id) !=' '">
                <span class="badge bg-info">  {{ getHotelNameById(element.hotel_id) }}</span>
            </div>
            <div v-else>
                {{ getHotelNameById(element.hotel_id) }}
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
    methods: {
        getRoleNameById(roleId) {
            const role = this.variables.roles.find(role => role.id === roleId);
            return role ? role.name : ' ';
        },
        getHotelNameById(hotelId) {
            const hotel = this.variables.hotels.find(hotel => hotel.id === hotelId);
            return hotel ? hotel.name : ' ';
        },
    },
    props: {
        variables: Object,
    },
    setup(props) {
        const typeBadge="badge badge-pill badge-info";
    }
}
</script>