<template>
    <app-modal
      :modal_id="modal_id"
      base_route="clients"
      :form="form"
      :validator="validator"
      :title="title_modal"
      :method_put="!method_create"
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
        <basic-input
          v-model:keyValue="form.phone_number"
          title="Teléfono"
          inputName="phone_number"
          type="number"
          :cols="6"
          :errors="validator.phone_number?.$errors"
          :required="(validator.phone_number?.required != undefined)"
        ></basic-input>
        <basic-input
          v-model:keyValue="form.country_id"
          title="Ciudad"
          inputName="country_id"
          type="select"
          :catalog = "countries"
          catalogKey ="id"
          catalogLabel ="name"
          :cols="6"
          :errors="validator.country_id?.$errors"
          :required="(validator.country_id?.required != undefined)"
        ></basic-input>
        <basic-input
          v-model:keyValue="form.password"
          title="contraseña"
          inputName="password"
          type="password"
          :cols="6"
          :errors="validator.password?.$errors"
          :required="(validator.password?.required != undefined)"
        ></basic-input>
        <basic-input
          v-model:keyValue="form.password_confirmation"
          title="Confirmar contraseña"
          inputName="password_confirmation"
          type="password"
          :cols="6"
          :errors="validator.password_confirmation?.$errors"
          :required="(validator.password_confirmation?.required != undefined)"
        ></basic-input>
      </template>
    </app-modal>
</template>

<script>
import AppModal from "@/Components/AppModal.vue";
import useValidation from "@/Composables/useValidation.js";
import useBasicCrud from "@/Composables/useBasicCrud.js";
import useRules from "@/Rules/ClientsRules.js";
import BasicInput from '@/Components/BasicInput.vue'
import { inject, ref, watch, reactive } from 'vue';
export default {
  components: {
    AppModal,
    BasicInput,
  },
  props: {
    modal_id: {
        type: String,
        default: 'modalAddClients'
    },
    countries: Array
  },
  setup(props){

    const method_create = ref(true);

    const formData = {
      id: '',
      name: '',
      email: '',
      phone_number: '',
      countries: '',
      password: '',
      password_confirmation: ''
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
    } = useBasicCrud({titleBase: 'Clientes', form, method_create, cleanFormData, validator, 
        validate, modal_id: props.modal_id, getRoute: 'clients', destroyRoute: 'clients'});

    const trigger = inject('trigger');

    watch(trigger, ()=>{
        if(trigger.value?.id == 'clients'){
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