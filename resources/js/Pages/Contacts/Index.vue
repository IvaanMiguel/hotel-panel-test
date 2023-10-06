<template>
  <div class="row">
    <div class="col-md-3 mb-3">
      <div class="card bg-white">
        <div class="card-body">
          <h4 class="fw-medium">Filtros</h4>
          <ul class="list-unstyled">
            <li class="fw-medium p-2 cursor-pointer d-flex align-items-center" @click="filterContacts('pendiente')"
              :class="{ 'disabled': selectedStatus === 'pendiente', 'selected': selectedStatus === 'pendiente', [statusColors.pendiente]: selectedStatus === 'pendiente' }">
              <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div class="circle-icon bg-light fs-16 text-primary me-3">
                  <i class="ri-error-warning-line"></i>
                </div>
                <div style="flex-grow: 1;">Pendientes</div>
                <span class="badge bg-danger">{{countPendiente}}</span>
              </div>
            </li>
            <li class="fw-medium p-2 cursor-pointer d-flex align-items-center" @click="filterContacts('atendido')"
              :class="{ 'disabled': selectedStatus === 'atendido', 'selected': selectedStatus === 'atendido', [statusColors.atendido]: selectedStatus === 'atendido' }">
              <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div class="circle-icon bg-light fs-16 text-primary me-3">
                  <i class="ri-check-line"></i>
                </div>
                <div style="flex-grow: 1;"> Atendidos</div>
                <span class="badge bg-success">{{countAtendido}}</span>
              </div>
            </li>
            <li class="fw-medium p-2 cursor-pointer d-flex align-items-center" @click="filterContacts('archivado')"
              :class="{ 'disabled': selectedStatus === 'archivado', 'selected': selectedStatus === 'archivado', [statusColors.archivado]: selectedStatus === 'archivado' }">
              <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div class="circle-icon bg-light fs-16 text-primary me-3">
                  <i class="ri-folder-line"></i>
                </div>
                <div style="flex-grow: 1;">Archivados</div>
                <span class="badge bg-primary">{{countArchivado}}</span>
              </div>
            </li>
            <li class="fw-medium p-2 cursor-pointer d-flex align-items-center" @click="filterContacts('all')"
              :class="{ 'disabled': selectedStatus === 'all', 'selected': selectedStatus === 'all', 'badge': selectedStatus === 'all' }">
              <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div class="circle-icon bg-light fs-16 text-primary me-3">
                  <i class="ri-star-line"></i>
                </div>
                <div style="flex-grow: 1;">Todos</div>
                <span class="badge bg-dark">{{ countTodos }}</span>
              </div>
            </li>
            <li class="fw-medium p-2 d-flex align-items-center" :class="{ 'disabled': selectedStatus === 'hotel' }">
              <div class="circle-icon bg-light fs-16 text-primary me-3">
                <i class="ri-hotel-line"></i>
              </div>
              <div> Filtrar por Hotel
                <select v-model="selectedHotel" class="form-select mt-2" @change="handleHotelChange">
                  <option value="" disabled>Selecciona un hotel</option>
                  <option v-for="hotel in uniqueHotels" :key="hotel.id" :value="hotel.id">{{ hotel.name }}</option>
                </select>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>


    <div class="col-md-9">
      <basic-table :data="filteredContacts" :tableHeaders="[
        {
          title: 'Mensaje',
          key: 'message',
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
        <template #message="element">
          <div class="text-ellipsis">{{ limitText(element.message, 60) }}</div>
        </template>
        <template #updated_at="element">
          {{ formatDate(element.updated_at) }}
        </template>

      </basic-table>
      <contacts-add-edit />
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
  methods: {
    formatDate(dateTime) {
      if (!dateTime) return '';
      const date = new Date(dateTime);
      const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
      return date.toLocaleDateString(undefined, options);
    },

    limitText(text, maxLength) {
      if (text && text.length > maxLength) {
        return text.slice(0, maxLength) + '...';
      }
      return text;
    },
  },
  props: {
    variables: Object,
  },
  setup(props) {
    const filteredContacts = ref([]);
    const selectedStatus = ref('pendiente');
    const selectedHotel = ref('');
    const countPendiente = ref(0);
    const countAtendido = ref(0);
    const countArchivado = ref(0);
    const countTodos = ref(0);
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
      countPendiente.value = contacts.filter((contact) => contact.status === 'pendiente').length;
      countAtendido.value = contacts.filter((contact) => contact.status === 'atendido').length;
      countArchivado.value = contacts.filter((contact) => contact.status === 'archivado').length;
      countTodos.value = props.variables.contacts.length;
      filterContacts(selectedStatus.value);
    });


    return {
      filteredContacts,
      selectedStatus,
      selectedHotel,
      countPendiente,
      countAtendido,
      countArchivado,
      hotels,
      countTodos,
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

.circle-icon {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 16px;
}
</style>
