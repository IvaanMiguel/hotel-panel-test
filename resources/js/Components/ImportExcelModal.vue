<template>
  <div
      class="modal fade"
      id="modalExcel"
      tabindex="-1"
      :aria-labelledby="id"
      aria-hidden="true"
      role="dialog"
  >
      <div class="modal-dialog modal-md modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header bg-light p-3">
                  <h5 class="modal-title" :id="id">{{ title }}</h5>
                  <button
                      class="btn-close"
                      type="button"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                  ></button>
              </div>
              <form
                  :action="route(routeName)"
                  method="POST"
                  class="needs-validation"
                  enctype="multipart/form-data"
                  novalidate
              >
                  <div class="modal-body">
                      <div class="row">  
                        <div class="col-md-12">
                          <div class="form-group mb-4">
                            <label for="file">Archivo</label>
                            <input
                              type="file"
                              name="file"
                              class="form-control"
                              accept=".xlsx, .xls"
                              @change="blockSubmit = false"
                            />
                          </div>
                        </div>                   
                      </div>

                      <input 
                        v-for="param in params" :key="param.name"
                        type="hidden" 
                        :name="param.name" 
                        :value="param.value"
                      >

                  </div>
                  <div class="modal-footer">
                      <slot name="hidden"></slot>
                      <input type="hidden" name="_token" :value="csrf" />
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-secondary" :disabled="blockSubmit">Importar</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</template>

<script>
import { inject, ref } from "vue";
export default {
  components: {
  },
  props: {
    title: String,
    routeName: String,
    params: Array,
  },
  setup(props){
    
    const blockSubmit = ref(true);

    return {
      blockSubmit,
      csrf: inject('csrf')
    }
  }
};
</script>

<style scoped>
</style>
