<template>
  <div
      class="modal fade"
      id="modalImportFile"
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
                            <label for="file">{{ label }}</label>
                            <input
                              type="file"
                              :name="input_name"
                              class="form-control"
                              :accept="valid_files"
                              @change="blockSubmit = false"
                            />
                          </div>
                        </div>
                        <div class="col-md-12" v-for="(checkbox) in checkboxes" :key="checkbox.name">
                          <div class="form-group mb-3">
                            <div class="form-check">
                              <input class="form-check-input" :true-value="1" :false-value="0" 
                              type="checkbox" v-model="checkbox.value" />
                              <label class="form-check-label">{{checkbox.label}}</label>
                              <input type="hidden" :name="checkbox.name" :value="checkbox.value">
                            </div>
                          </div>
                        </div>                 
                      </div>
                  </div>
                  <div class="modal-footer">
                      <slot name="hidden"></slot>
                      <input type="hidden" name="_token" :value="csrf" />
                      <template v-if="able">
                        <input v-if="id" type="hidden" :name="able + 'able_id'" :value="id" />
                        <input v-if="type" type="hidden" :name="able + 'able_type'" :value="type" />
                      </template>
                      <input v-else-if="id" type="hidden" name="id" :value="id" />
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-secondary" :disabled="blockSubmit">Guardar</button>
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
    able: String,
    id: Number,
    type: String,
    title: String,
    routeName: String,
    valid_files: {
      type: String,
      default: '.xlsx, .xls'
    },
    label: {
      type: String,
      default: 'Archivo'
    },
    input_name: {
      type: String,
      default: 'file'
    },
    checkboxes: Array,
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
