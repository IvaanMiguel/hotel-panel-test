<template>
    <div class="row">
        <div class="col-md-2">
            <ul class="list-group">
                <li class="list-group-item">
                    <button class="btn btn-primary" @click="filterContacts('pendiente')">Pendientes</button>
                </li>
                <li class="list-group-item">
                    <button class="btn btn-success" @click="filterContacts('atendido')">Atendidos</button>
                </li>
                <li class="list-group-item">
                    <button class="btn btn-warning" @click="filterContacts('archivado')">Archivados</button>
                </li>
                <li class="list-group-item">
                    <button class="btn btn-secondary" @click="filterContacts('all')">Limpiar Filtros</button>
                </li>
            </ul>
        </div>
        <div class="col-md-10">
            <basic-table
                :data="filteredContacts"
                :tableHeaders="[
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
                            min-width: 160px;
                            max-width: 160px;
                            white-space:normal;
                        "
                    >
                        {{ element.address }}
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
    const selectedStatus = ref('all');

    const filterContacts = (status) => {
      if (props.variables?.contacts) {
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
      ContactsAddEdit,
    };
  },
};
</script>

<style scoped>
</style>