<template>
  <div class="row">
    <div class="col-md-2 mb-3">
      <div class="card bg-white">
        <div class="card-body">
          <h4 class="fw-medium">Filtros</h4>
          <ul class="list-unstyled">
            <li class="fw-medium p-2 cursor-pointer" @click="filterContacts('pendiente')"
              :class="{ 'disabled': selectedStatus === 'pendiente', 'selected': selectedStatus === 'pendiente', [statusColors.pendiente]: selectedStatus === 'pendiente' }">
              Pendientes
            </li>
            <li class="fw-medium p-2 cursor-pointer" @click="filterContacts('atendido')"
              :class="{ 'disabled': selectedStatus === 'atendido', 'selected': selectedStatus === 'atendido', [statusColors.atendido]: selectedStatus === 'atendido' }">
              Atendidos
            </li>
            <li class="fw-medium p-2 cursor-pointer" @click="filterContacts('archivado')"
              :class="{ 'disabled': selectedStatus === 'archivado', 'selected': selectedStatus === 'archivado', [statusColors.archivado]: selectedStatus === 'archivado' }">
              Archivados
            </li>
            <li class="fw-medium p-2 cursor-pointer" @click="filterContacts('all')"
            :class="{ 'disabled': selectedStatus === 'all', 'selected': selectedStatus === 'all', 'badge': selectedStatus === 'all' }">
            Todos
          </li>
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
          dataStyle: (element) => {
            if (element.status === 'pendiente') {
              return statusColors.pendiente;
            } else if (element.status === 'archivado') {
              return statusColors.archivado;
            } else if (element.status === 'atendido') {
              return statusColors.atendido; 
            } else {
              return '';
            }
          }
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
      <contacts-add-edit/>
    </div>
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
    const selectedHotel = ref('');

    const contacts = props.variables.contacts || [];
    const hotels = contacts.map((contact) => contact.hotel);

    const uniqueHotels = contacts.reduce((unique, contact) => {
      const hotelId = contact.hotel.id;
      if (!unique.find(h => h.id === hotelId)) {
        unique.push(contact.hotel);
      }
      return unique;
    }, []);
    const statusColors = {
      pendiente: 'badge bg-danger', 
      atendido: 'badge bg-success', 
      archivado: 'badge bg-primary',
    };

    const filterContacts = (status) => {
      if (props.variables?.contacts) {
        if (status === 'all') {
          filteredContacts.value = props.variables.contacts;
        } else if (status === 'hotel') {
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
    const handleHotelChange = () => {
      filterContacts('hotel');
    };

    watch(() => props.variables.contacts, () => {
      if (selectedStatus.value === 'hotel') {
        filterContactsByHotel(selectedHotel.value);
      } else {
        filterContacts(selectedStatus.value);
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
      handleHotelChange,
      statusColors,
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
