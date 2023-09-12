<template>
    <div class="row">
        <div class="col-3 mb-3">
            <button @click="filterContacts('pendiente')">Pendientes</button>
            <button @click="filterContacts('atendido')">Atendidos</button>
            <button @click="filterContacts('archivado')">Archivados</button>
            <button @click="clearFilters">Limpiar Filtros</button>
        </div>
      
    
        <div class="col-9 flex">
            <basic-table
                :data="filteredContacts"
                :tableHeaders="[
                {
                    title: 'Mensaje',
                    key: 'message',
                },
                {
                    title: 'Estado',
                    key: 'status',
                },
                {
                    title: 'Actualización',
                    key: 'updated_at',
                },
                ]"
                table_id="contactsTable"
                moduleName="contacts"
                detailsBtn
            >
            <template #name="element">
                <div class="d-flex align-items-center">
                <div class="flex-grow-1">x
                    <h5 class="fs-14 mb-1">{{ element.name }}</h5>
                    <p class="text-muted mb-0" v-if="element">{{ element.slug }}</p>
                </div>
                </div>
            </template>
            <template #address="element">
                <div
                style="
                    word-wrap: break-word;
                    min-width: 160px;
                    max-width: 160px;
                    white-space: normal;
                "
                >
                {{ element.updated_at }}
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
        </div>
  
      <contacts-add-edit />
    </div>
  </template>
  

  <script>
import BasicTable from '@/Components/BasicTable.vue';
import BtnOption from '@/Components/BtnOption.vue';
import { ref, watch, onMounted } from 'vue';

export default {
  components: {
    BasicTable,
    BtnOption,
  },
  props: {
    variables: Object,
  },
  setup(props) {
    const filteredContacts = ref([]);
    const selectedStatus = ref('all'); // Mostrar todos los contactos por defecto

    // Función para filtrar los contactos
    const filterContacts = (status) => {
      if (props.variables && props.variables.contacts) {
        if (status === 'all') {
          filteredContacts.value = props.variables.contacts; // Mostrar todos los contactos
        } else {
          filteredContacts.value = props.variables.contacts.filter(
            (contact) => contact.status === status
          );
        }
      }
    };

    // Función para limpiar los filtros y mostrar todos los contactos
    const clearFilters = () => {
      selectedStatus.value = 'todos';
    };

    // Observar cambios en variables.contacts y actualizar los contactos filtrados
    watch(() => props.variables.contacts, () => {
      filterContacts(selectedStatus.value);
    });

    // Ejecutar filterContacts al cargar la página
    onMounted(() => {
      filterContacts(selectedStatus.value);
    });

    return {
      filteredContacts,
      selectedStatus,
      filterContacts,
      clearFilters,
    };
  },
};
</script>