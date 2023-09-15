<template>
    <div class="d-flex justify-content-around">
        <div class="card card-height-100" v-for="(country, index) in topCountries" :key="index">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="avatar-sm flex-shrink-0">
                  <span class="bg-soft-success text-success rounded-2 fs-2 p-1">
                    #{{ index + 1 }}
                  </span>
                </div>
                <div class="flex-grow-1 ms-3">
                  <p class="text-uppercase fw-medium text-muted mb-3">Ranking Por País</p>
                  <h4 class="fs-4 mb-3">
                    {{ country[0] }}: {{ country[1] }} Clientes
                  </h4>
                </div>
              </div>
            </div><!-- end card body -->
        </div>
        <div class="card card-height-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                            <i class="bx bxs-user-account"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-uppercase fw-medium text-muted mb-3">Total de Clientes Registrados</p>
                        <h4 class="fs-4 mb-3"><span>{{ clientsWithCountryName.length }} Clientes</span></h4>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
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

    <clients-add-edit />
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
