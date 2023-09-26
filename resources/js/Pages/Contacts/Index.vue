<template>
  <div class="row">
    <div class="col-md-2 mb-3">
      <div class="card bg-white">
        <div class="card-body">
          <h4 class="fw-medium">Filtros</h4>
          <ul class="list-unstyled">
            <li class="fw-medium p-2 cursor-pointer" @click="filterContacts('pendiente')"
              :class="{ 'disabled': selectedStatus === 'pendiente', 'selected': selectedStatus === 'pendiente' }">
              Pendientes
            </li>
            <li class="fw-medium p-2 cursor-pointer" @click="filterContacts('atendido')"
              :class="{ 'disabled': selectedStatus === 'atendido', 'selected': selectedStatus === 'atendido' }">
              Atendidos
            </li>
            <li class="fw-medium p-2 cursor-pointer" @click="filterContacts('archivado')"
              :class="{ 'disabled': selectedStatus === 'archivado', 'selected': selectedStatus === 'archivado' }">
              Archivados
            </li>
            <li class="fw-medium p-2 cursor-pointer" @click="filterContacts('all')"
              :class="{ 'disabled': selectedStatus === 'all' }">
              Limpiar Filtros
            </li>
            <!-- Agrega la opción para filtrar por hotel -->
            <li class="fw-medium p-2" :class="{ 'disabled': selectedStatus === 'hotel' }">
              Filtrar por Hotel
              <select v-model="selectedHotel" class="form-select mt-2" @change="handleHotelChange">
                <option value="" disabled>Selecciona un hotel</option>
                <option v-for="hotel in uniqueHotels" :key="hotel.id" :value="hotel.id">{{ hotel.name }}</option>
              </select>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-10">
      <basic-table :data="filteredContacts" :tableHeaders="[
        {
          title: 'Mensaje',
          key: 'message',
          dataStyle: () => 'text-wrap'
        },
        {
          title: 'Estado',
          key: 'status',
        },
        {
          title: 'Actualización',
          key: 'updated_at',
        },
      ]" table_id="contactsTable" moduleName="contacts" detailsBtn :createBtn="false">
        <template #name="element">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0 me-3">
              <div class="avatar-sm bg-light rounded p-1" style="overflow: hidden;">
                <img :src="element.cover?.full_path ?? getAvatar(element.name)" alt="" class="img-fluid d-block">
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
      </basic-table>
    </div>

    <contacts-add-edit />
  </div>
</template>

<script>
import BasicTable from '@/Components/BasicTable.vue';
import BtnOption from '@/Components/BtnOption.vue';
import ContactsAddEdit from '@/Components/Contacts/ContactsAddEdit.vue'
import { ref, watch, onMounted } from 'vue';

export default {
  components: {
    BasicTable,
    BtnOption,
    ContactsAddEdit,
  },
  props: {
    variables: Object,
  },
  setup(props) {
    const filteredContacts = ref([]);
    const selectedStatus = ref('pendiente');
    const selectedHotel = ref(''); // Agregar una referencia para el hotel seleccionado

    // Utiliza .map() para extraer el objeto `hotels` del arreglo `contacts`
    const contacts = props.variables.contacts || [];
    const hotels = contacts.map((contact) => contact.hotel);

    // Utiliza un conjunto para obtener hoteles únicos
    const uniqueHotelsSet = new Set(hotels);
    const uniqueHotels = Array.from(uniqueHotelsSet);

    console.log(uniqueHotels);

    const filterContacts = (status) => {
      if (props.variables?.contacts) {
        if (status === 'all') {
          filteredContacts.value = props.variables.contacts;
        } else if (status === 'hotel') {
          // Filtra por hotel seleccionado
          filteredContacts.value = props.variables.contacts.filter(
            (contact) => contact.hotel.id === selectedHotel.value
          );
        } else {
          filteredContacts.value = props.variables.contacts.filter(
            (contact) => contact.status === status
          );
        }
        selectedStatus.value = status;
      }
    };

    // Maneja el cambio en la selección del hotel
    const handleHotelChange = () => {
      filterContacts('hotel');
    };

    watch(() => props.variables.contacts, () => {
      if (selectedStatus.value === 'hotel') {
        filterContactsByHotel(selectedHotel.value); // Vuelve a aplicar el filtro de hotel si se seleccionó esta opción
      } else {
        filterContacts(selectedStatus.value); // Vuelve a aplicar el filtro por estado
      }
    });

    onMounted(() => {
      filterContacts(selectedStatus.value);
    });

    return {
      filteredContacts,
      selectedStatus,
      selectedHotel,
      hotels,
      filterContacts,
      ContactsAddEdit,
      uniqueHotels,
      handleHotelChange, // Agrega la función handleHotelChange al objeto retornado
    };
  },
};
</script>

<style scoped>
.selected {
  background-color: black;
  color: white;
}
</style>
<style scoped>
.selected {
  background-color: black;
  color: white;
}
</style>
