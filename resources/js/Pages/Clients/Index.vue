<template>
  <div class="d-flex justify-content-around">
    <div class="card bg-info h-100 flex-fill m-4" v-for="(country, index) in topCountries" :key="index">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <p class="text-uppercase fw-medium text-white-50 mb-0">País</p>
                </div>
            </div>
            <div class="d-flex align-items-end justify-content-between mt-4">
                <div>
                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white">
                        {{ country[0] }}: {{ country[1] }}
                    </h4>
                    <p class="text-white-50">Clientes</p>
                </div>
                <div class="avatar-sm flex-shrink-0">
                    <span class="avatar-title bg-soft-light rounded fs-3">
                        #{{ index + 1 }}                        
                    </span>
                </div>
            </div>
        </div><!-- end card body -->
    </div><!-- end card -->

    <div class="card bg-warning h-100 flex-fill m-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <p class="text-uppercase fw-medium text-white-50 mb-0">Total</p>
                </div>
            </div>
            <div class="d-flex align-items-end justify-content-between mt-4">
                <div>
                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white">
                        {{ clientsWithCountryName.length }}
                    </h4>
                    <p class="text-white-50">Clientes</p>
                </div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-soft-light rounded fs-3">
                    <i class="bx bx-user-circle"></i>
                  </span>
              </div>
            </div>
        </div><!-- end card body -->
    </div><!-- end card -->
</div>


    <basic-table
        :data="clientsWithCountryName"
        :tableHeaders="[
            {
                title: 'Nombre',
                key: 'name',
            },
            {    
                title: 'Correo',
                key: 'email',
            },
            {    
                title: 'País',
                key: 'countryName',
            },
            {    
                title: 'Teléfono',
                key: 'phone_number',
            },
        ]"
        table_id="clientsTable"
        moduleName="clients"
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

    <clients-add-edit :countries = "variables.countries"/>
</template>

<script>
import BasicTable from '@/Components/BasicTable.vue'
import BtnOption from '@/Components/BtnOption.vue'
import ClientsAddEdit from '@/Components/Clients/ClientsAddEdit.vue'

export default {
  components: {
    BasicTable,
    BtnOption,
    ClientsAddEdit,
  },
  props: {
    variables: Object,
  },
  setup(props) {
    const clientsWithCountryName = props.variables.clients.map(client => ({
      ...client,
      countryName: client.country ? client.country.name : '',
    }));

    // Filtra los países para incluir solo aquellos con nombres válidos
    const validCountries = clientsWithCountryName
      .reduce((acc, client) => {
        const country = client.countryName;
        if (country && country.trim() !== '') {
          acc[country] = (acc[country] || 0) + 1;
        }
        return acc;
      }, {});

    // Convierte el objeto en un array de pares [país, cantidad] y ordena por cantidad descendente
    const sortedCountryCounts = Object.entries(validCountries).sort((a, b) => b[1] - a[1]);

    // Obtiene los tres primeros países y sus cantidades
    const topCountries = sortedCountryCounts.slice(0, 3);

    return {
      clientsWithCountryName,
      topCountries
    };
  },
};
</script>
