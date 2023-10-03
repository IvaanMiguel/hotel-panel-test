<template>
    <app-modal
      :modal_id="modal_id"
      base_route="rooms"
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
           @input="updateSlug"
        ></basic-input>
        <basic-input
          v-model:keyValue="form.slug"
          title="slug"
          inputName="slug"
          type="hidden"
          :cols="6"
          :errors="validator.slug?.$errors"
          :required="(validator.slug?.required != undefined)"
        ></basic-input>

        <basic-input
          v-model:keyValue="form.max_people"
          title="Personas Por habitación"
          inputName="max_people"
          type="number"
          :cols="6"
          :errors="validator.max_people?.$errors"
          :required="(validator.max_people?.required != undefined)"
        ></basic-input>
        
        <basic-input
          v-model:keyValue="form.hotel_id"
          title="Hotel"
          inputName="hotel_id"
          type="select"
          :catalog = "hotels"
          catalogKey ="id"
          catalogLabel ="name"
          :cols="6"
          :errors="validator.hotel_id?.$errors"
          :required="(validator.hotel_id?.required != undefined)"
        ></basic-input>
                
        <basic-input
          v-model:keyValue="form.type_id"
          title="Habitacion"
          inputName="type_id"
          type="select"
          :catalog = "rooms"
          catalogKey ="id"
          catalogLabel ="name"
          :cols="6"
          :errors="validator.type_id?.$errors"
          :required="(validator.type_id?.required != undefined)"
        ></basic-input>

        <basic-input
          v-model:keyValue="form.description"
          title="Descripción"
          inputName="description"
          type="textarea"
          :cols="12"
          :errors="validator.description?.$errors"
          :required="(validator.description?.required != undefined)"
        ></basic-input>


      </template>
    </app-modal>
</template>


<script>
import AppModal from "@/Components/AppModal.vue";
import useValidation from "@/Composables/useValidation.js";
import useBasicCrud from "@/Composables/useBasicCrud.js";
import useRules from "@/Rules/RoomsRules.js";
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
        default: 'modalAddRooms'
    },
    hotels: Array,
    rooms: Array
  },
  methods: {
    updateSlug() {
      this.form.slug = this.form.name.toLowerCase().replace(/\s+/g, '-');
    },
  },
  setup(props){

    const method_create = ref(true);

    const formData = {
      id: '',
      name: '',
      description: '',
      max_people: '',
      type_id: '',
      hotel_id: '',
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
    } = useBasicCrud({titleBase: 'Rooms', form, method_create, cleanFormData, validator, 
        validate, modal_id: props.modal_id, getRoute: 'rooms', destroyRoute: 'rooms'});

    const trigger = inject('trigger');

    watch(trigger, ()=>{
        if(trigger.value?.id == 'rooms'){
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