<template>
  <div>
    <div class="row">
      <div class="col-xxl-6" v-for="(rate, index) in variables.rates" :key="index">
        <div class="tarjeta">
          <div class="card">
            <div class="card-body">
              <!-- edit button -->
              <div class="position-absolute top-0 end-0">
                    <btn-option :action="{ id: 'rates', method: 'edit', params: { id: rate.id } }" type="button"
                    color="success"  icon="ri-pencil-fill fs-16" v-if="(can('rates.update'))"></btn-option>
                  </div>
              <!-- Tarifa -->
              <div class="seccion mb-4">
                <div class="titulo">
                  <btn-option :btnRoute="route('rates.show', rate.id)" type="button" color="light"
                    text="tarifa" icon="ri-bank-card-fill" v-if="(can('rates.get'))"></btn-option>
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
                  <!-- <div class="titulo">
                    <i class="ri-money-dollar-box-fill"></i>
                    <span class="card-title">Precio</span>
                    <div class="descripcion">
                      <p class="card-text">{{ rate.price ? rate.price : 'Sin precio' }}</p>
                    </div>
                  </div>

                  <div style="width: 50%;"></div> -->

                  <!-- "Extra" -->
                  <!-- <div class="titulo">
                    <i class="ri-money-dollar-circle-fill"></i>
                    <span class="card-title">Extra</span>
                    <div class="descripcion">
                      <p class="card-text">{{ rate.extra ? rate.extra : 'Sin extra' }}</p>
                    </div>
                  </div>
                </div>
              </div> -->

              <!-- Estado -->
              <!-- <div class="seccion mb-4">
                <div class="titulo">
                  <i class="ri-flag-fill"></i>
                  <span class="card-title">Estado</span>
                </div>
                <div class="descripcion">
                  <p class="card-text">{{ rate.status ? rate.status : 'Sin Estatus' }}</p>
                </div>
              </div> -->
              </div>
            </div>
              <!-- Botones -->
              <div class="row justify-content-center ">
                  <div class="col-md-4 ">
                    <btn-option :action="{ id: 'rates' , method: 'destroy', params: { id: rate.id } }"
                    type="button" color="danger" text="Eliminar" icon="ri-delete-bin-5-fill"
                    v-if="(can('rates.destroy'))"></btn-option>
                  </div>
                  <div class="col-md-4">
                    <btn-option :btnRoute="route('rates.show', rate.id)" type="button" color="primary"
                    text="Detalles" icon="ri-eye-fill" v-if="(can('rates.get'))"></btn-option>
                  </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <rates-add-edit />
</template>


<script>
import RatesAddEdit from '@/Components/Rates/RatesAddEdit.vue';
import BtnOption from '@/Components/BtnOption.vue'
export default {
  components: {
    BtnOption,
    RatesAddEdit
  },
  props: {
    variables: Object,
  },
  computed: {
  },
  setup(props) {



    return {

    };
  }
};

</script>