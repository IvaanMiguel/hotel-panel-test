<template>
    <app-modal-new
      :modal_id="modal_id"
      base_route="users"
      :form="form"
      :validator="validator"
      :title="title_modal"
      :method_create="method_create"
      @onSubmit="methods.submitForm($event)"
    >
    <template #modalBody>
        <basic-input
          v-model:keyValue="form.name"
          title="Nombre"
          inputName="name"
          type="text"
          :cols="6"
          :errors="validator.name?.$errors"
          :required="(validator.name?.required != undefined)"
        ></basic-input>

        <basic-input
          v-model:keyValue="form.email"
          title="Correo"
          inputName="email"
          type="text"
          :cols="6"
          :errors="validator.email?.$errors"
          :required="(validator.email?.required != undefined)"
        ></basic-input>

      </template>
    </app-modal-new>
</template>


<script>
import AppModalNew from "@/Components/AppModalNew.vue";
import useValidation from "@/Composables/useValidation.js";
import useBasicCrud from "@/Composables/useBasicCrud.js";
import useRules from "@/Rules/UsersRules.js";
import BasicInput from '@/Components/BasicInput.vue'
import { inject, ref, watch, reactive } from 'vue';
export default {
  components: {
    AppModalNew,
    BasicInput,
  },
  props: {
    modal_id: {
        type: String,
        default: 'modalAddUsers'
    },
  },
  setup(props){

    const method_create = ref(true);

    const formData = {
      id: '',
      name: '',
      email: '',
    }

    const cleanFormData = {...formData}

    const form = reactive(formData);
    
    const { rules } = useRules();

    const {
        validator,
        validate
    } = useValidation(rules, form);

    const {
        title_modal,
        methods,
    } = useBasicCrud({titleBase: 'Usuarios', form, method_create, cleanFormData, validator, 
        validate, modal_id: props.modal_id, getRoute: 'users', destroyRoute: 'users'});

    const trigger = inject('trigger');

    watch(trigger, ()=>{
        if(trigger.value?.id == 'users'){
          methods[trigger.value?.method](trigger.value?.params)
        }
    })

    return {
        form,
        validator,
        title_modal,
        method_create,
        methods,
    }
  }
};
</script>