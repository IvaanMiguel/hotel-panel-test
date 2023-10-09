<template>
    <div>
        <basic-table :data="variables.rooms" :tableHeaders="[
            {
                title: 'Nombre',
                key: 'name',
            },
            {
                title: 'Descripción',
                key: 'description',
            },
            {
                title:'Hotel',
                key:'hotel_id'
            },
            {
                title: 'Capacidad',
                key: 'max_people',
            },
        ]" table_id="roomsTable" moduleName="rooms" detailsBtn>
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
            <template #max_people="element">
                <div class="text-center">
                    <span class="badge bg-info"> {{ element.max_people }} </span>     
                </div>
            </template>
            <template #description="element">
                <div class="description-text">
                    {{ cut(element.description) }}
                </div>
            </template>
            <template #hotel_id="element">
                <div class="text center">
                    <div v-if="getHotelNameById(element.hotel_id) =='Malecón'">
                        <span class="badge bg-info"> {{ getHotelNameById(element.hotel_id) }} </span>
                    </div>
                   <div v-else-if="getHotelNameById(element.hotel_id) =='Centro Histórico'">
                    <span class="badge bg-dark"> {{ getHotelNameById(element.hotel_id) }} </span>
                   </div>
                    
                </div>
            </template>
        </basic-table>
        <rooms-add-edit :rooms = "variables.rooms" :hotels = "variables.hotels"/>
    </div>
</template>
<script>
import BasicTable from '@/Components/BasicTable.vue'
import BtnOption from '@/Components/BtnOption.vue'
import RoomsAddEdit from '@/Components/Rooms/RoomsAddEdit.vue'
export default {
    components: {
        BasicTable,
        BtnOption,
        RoomsAddEdit,
    },
    methods:{
         cut(text){
            return text
            .replace(/^(.{50}[^\s]*).*/, "$1...");
        },
        getHotelNameById(hotelId) {
            const hotel = this.variables.hotels.find(hotel => hotel.id === hotelId);
            return hotel ? hotel.name : ' ';
        }

    },
    props: {
        variables: Object,
    },
    setup(props) {
    }
}
</script>

<style scoped>
.description-text {
    white-space: pre-line;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

</style>