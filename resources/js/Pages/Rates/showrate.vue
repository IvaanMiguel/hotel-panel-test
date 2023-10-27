<template>
    <div class="card  col-md-5">
      <div class="card-body">
        <h2 class="card-title mb-3 text-center">{{ variables.rate.name }}</h2>
        <hr>
        <p class="text-center">{{ variables.rate.description }}</p>
        <div class="row">
          <div class="col-6">
            <div class="d-flex mt-4">
              <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                  <i class="ri-money-dollar-box-fill"></i>
                </div>
              </div>
              <div class="flex-grow-1 overflow-hidden">
                <span><p class="mb-1">Precio: </p><h6 class="text-truncate mb-0">No Price</h6></span>
              </div>
            </div>
          </div>
          <!--end col-->
          <div class="col-6">
            <div class="d-flex mt-4">
              <div class="flex-shrink-0 avatar-xs align-self-center mx-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                  <i class="ri-money-dollar-box-fill"></i>
                </div>
              </div>
              <div class="overflow-hidden">
                <p class="mb-1">Precio Por Persona:</p>
                <a href="#" class="fw-semibold">$1500</a>
              </div>
            </div>
          </div>
          <!--end col-->
        </div>
        <!--end row-->
      </div>
      <!--end card-body-->
    </div><!-- end card -->
    <basic-table
    :data="variables.rate.reservations"
    :tableHeaders="[

        {
            title: 'Cliente',
            key: 'client.name',
        },
        {
            title: 'Costo',
            key: 'amount',
        },
        {    
            title: 'Cantidad de Personas',
            key: 'amount_of_people',
        },
        {    
            title: 'Estado',
            key: 'status',
        },
    ]"
    table_id="clientsTable"
    moduleName="clients"
    detailsBtn :createBtn="false"
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
    </basic-table>
  </template>
  
  <script>
  import BasicTable from '@/Components/BasicTable.vue'
  export default {
    components: {
        BasicTable,
    },
    props: {
      variables: Object,
    },
  };
  </script>
  