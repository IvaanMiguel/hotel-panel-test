<template>
    <div class="row">
        <div class="col-md-2 mb-3">
            <div class="card bg-white">
              <div class="card-body">
                <h4 class="fw-medium">Filtros</h4>
                <ul class="list-unstyled">
                  <li
                    class="fw-medium p-2 cursor-pointer"
                    @click="filterContacts('pendiente')"
                    :class="{ 'disabled': selectedStatus === 'pendiente', 'selected': selectedStatus === 'pendiente' }"
                  >
                    Pendientes
                  </li>
                  <li
                    class="fw-medium p-2 cursor-pointer"
                    @click="filterContacts('atendido')"
                    :class="{ 'disabled': selectedStatus === 'atendido', 'selected': selectedStatus === 'atendido' }"
                  >
                    Atendidos
                  </li>
                  <li
                    class="fw-medium p-2 cursor-pointer"
                    @click="filterContacts('archivado')"
                    :class="{ 'disabled': selectedStatus === 'archivado', 'selected': selectedStatus === 'archivado' }"
                  >
                    Archivados
                  </li>
                  <li
                    class="fw-medium p-2 cursor-pointer"
                    @click="filterContacts('all')"
                    :class="{ 'disabled': selectedStatus === 'all' }"
                  >
                    Limpiar Filtros
                  </li>
                </ul>
              </div>
            </div>
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
            filteredContacts.value = props.variables.contacts;
          } else {
            filteredContacts.value = props.variables.contacts.filter(
              (contact) => contact.status === status
            );
          }
          selectedStatus.value = status;
        }
      };
  
      watch(() => props.variables.contacts, () => {
        filterContacts(selectedStatus.value);
      });
  
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
  .selected {
    background-color: black;
    color: white;
  }
  </style>