<template>
  <div>
    <div class="row">
      <div class="col-xxl-6" v-for="(rate, index) in variables.rates" :key="index">
        <div class="tarjeta">
          <div class="card">
            <div class="card-body">
              <!-- Tarifa -->
              <div class="seccion mb-4"> 
                <div class="titulo">
                  <i class="ri-bank-card-fill"></i>
                  <span class="card-title">Tarifa</span> 
                </div>
                <div class="descripcion">
                  <p class="card-text">{{ rate.name }}</p>
                </div>
              </div>

              <!-- Descripción -->
              <div class="seccion mb-4">
                <div class="titulo">
                  <i class="ri-error-warning-fill"></i>
                  <span class="card-title">Descripción</span> 
                </div>
                <div class="descripcion">
                  <p class="card-text">{{ rate.description }}</p>
                </div>
              </div>

              <div class="mb-4"> 
                <div class="d-flex align-items-center">
                  <!-- "Precio" -->
                  <div class="titulo">
                    <i class="ri-money-dollar-box-fill"></i>
                    <span class="card-title">Precio</span> 
                    <div class="descripcion">
                      <p class="card-text">{{ rate.price ? rate.price : 'Sin precio' }}</p>
                    </div>
                  </div>

                  <div style="width: 50%;"></div>

                  <!-- "Extra" -->
                  <div class="titulo">
                    <i class="ri-money-dollar-circle-fill"></i>
                    <span class="card-title">Extra</span> 
                    <div class="descripcion">
                      <p class="card-text">{{ rate.extra ? rate.extra : 'Sin extra' }}</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Estado -->
              <div class="seccion mb-4"> 
                <div class="titulo">
                  <i class="ri-flag-fill"></i>
                  <span class="card-title">Estado</span> 
                </div>
                <div class="descripcion">
                  <p class="card-text">{{ rate.status ? rate.status : 'Sin Estatus' }}</p>
                </div>
              </div>

              <!-- Botones -->
              <div class="d-flex flex-row">
                <button @click="methods.edit({ id: rate.id })" class="btn btn-primary flex-fill me-1"
                  data-mdb-ripple-color="dark">
                  <i class="ri-edit-line ri-lg"></i> Editar
                </button>
                <button @click="methods.destroy({ id: rate.id })" class="btn btn-danger flex-fill ms-1">
                  <i class="ri-delete-bin-line ri-lg"></i> Eliminar
                </button>
                <button class="btn btn-success flex-fill ms-1">
                  <i class="ri-information-line ri-lg"></i> Detalles
                </button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <rates-add-edit/>
  </div>
</template>


<script>
import RatesAddEdit from '@/Components/Rates/RatesAddEdit.vue';
import useBasicCrud from '@/Composables/UseBasicCrud.js';
export default {
  components: {
    RatesAddEdit
  },
  props: {
    variables: Object,
  },
  computed: {
  },
  setup(props) {

    const {
      edit,
      title_modal,
      methods,
    } = useBasicCrud({ titleBase: 'Rates', getRoute: 'rates', destroyRoute: 'rates' });

    return {
      methods,
      title_modal,
      edit,
    };
  }
};

</script>