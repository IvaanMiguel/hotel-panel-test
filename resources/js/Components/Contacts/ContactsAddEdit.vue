<template>
    <app-modal
      :modal_id="modal_id"
      base_route="contacts"
      :form="form"
      :validator="validator"
      :title="title_modal"
      :method_put="!method_create"
      :method_create="method_create"
      @onSubmit="methods.submitForm($event)"
    >
    <template #modalBody>
        <basic-input
        v-model:keyValue="form.message"
        title="Mensaje"
        inputName="message"
        type="text"
        :errors="validator.message?.$errors"
        :required="(validator.message?.required != undefined)"
      ></basic-input>
        <basic-input
          v-model:keyValue="form.status"
          title="Escribir Estado"
          inputName="status"
          type="text"
          :errors="validator.status?.$errors"
          :required="(validator.status?.required != undefined)"
        ></basic-input>
        <basic-input
        v-model:keyValue="form.client_id"
        title="Client ID"
        inputName="client_id"
        type="hidden"
        :required="(validator.client_id?.required != undefined)"
      ></basic-input>
        <basic-input
        v-model:keyValue="form.hotel_id"
        title="Hotel ID"
        inputName="hotel_id"
        type="hidden"
        :required="(validator.hotel_id?.required != undefined)"
        ></basic-input>
<!--         
        <basic-input
          v-model:keyValue="form.role"
          title="Correo"
          inputName="role"
          type="select"
          :catalog = "roles"
          catalogKey ="id"
          catalogLabel ="name"
          :cols="6"
          :errors="validator.role?.$errors"
          :required="(validator.role?.required != undefined)"
        ></basic-input> -->


      </template>
    </app-modal>
</template>


<script>
import AppModal from "@/Components/AppModal.vue";
import useValidation from "@/Composables/useValidation.js";
import useBasicCrud from "@/Composables/useBasicCrud.js";
import ContactsRules from "@/Rules/ContactsRules.js";
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
        default: 'modalAddContacts'
    },
    roles: Array
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
    
    const { rules } = ContactsRules();

    const {
        validator,
        validate
    } = useValidation(rules, form);

    const {
        title_modal,
        methods,
    } = useBasicCrud({titleBase: 'Contactos', form, method_create, cleanFormData, validator, 
        validate, modal_id: props.modal_id, getRoute: 'contacts', destroyRoute: 'contacts'});

    const trigger = inject('trigger');

    watch(trigger, ()=>{
        if(trigger.value?.id == 'contacts'){
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