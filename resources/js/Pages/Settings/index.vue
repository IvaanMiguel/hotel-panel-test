
<template>
      <form
        :action="route('settings.' + (method_create ? 'update' : 'edit'))"
        method="POST"
        class="needs-validation"
        enctype="multipart/form-data"
        novalidate
        id="edit-settings-form"
        @submit="
            ($event) => {
                submitForm($event);
                preventDoubleForm = true;
            }
        "
      >
      <div class="card">
        <div class="card-body p-4" >
          <div class="row">
            
            <basic-input
                v-model:keyValue="form.email"
                title="Correo Electrónico de Notificaciones"
                inputName="email"
                type="text"
                :cols="12"
                :errors="validator.email?.$errors"
                :required="(validator.email?.required != undefined)"
              ></basic-input>
              
              <basic-input
                v-model:keyValue="form.google_recaptcha_public_key"
                title="Google recaptcha Public Key"
                inputName="google_recaptcha_public_key"
                type="text"
                :cols="6"
                :errors="validator.google_recaptcha_public_key?.$errors"
                :required="(validator.google_recaptcha_public_key?.required != undefined)"
              ></basic-input>

              <basic-input
                v-model:keyValue="form.google_recaptcha_private_key"
                title="Google recaptcha Private Key"
                inputName="google_recaptcha_private_key"
                type="text"
                :cols="6"
                :errors="validator.google_recaptcha_private_key?.$errors"
                :required="(validator.google_recaptcha_private_key?.required != undefined)"
              ></basic-input>

              <basic-input
                v-model:keyValue="form.google_recaptcha"
                title="Activar google recaptcha"
                inputName="google_recaptcha"
                type="switch"
                :cols="6"
                :errors="validator.google_recaptcha?.$errors"
                :required="(validator.google_recaptcha?.required != undefined)"
              ></basic-input>
              
              <basic-input
                v-model:keyValue="form.production"
                title="Activar modo producción"
                inputName="production"
                type="switch"
                :cols="6"
                :errors="validator.production?.$errors"
                :required="(validator.production?.required != undefined)"
              ></basic-input>

              <basic-input
                v-model:keyValue="form.production_stripe_public_key"
                title="Stripe Production Public Key"
                inputName="production_stripe_public_key"
                type="text"
                :cols="6"
                :errors="validator.production_stripe_public_key?.$errors"
                :required="(validator.production_stripe_public_key?.required != undefined)"
              ></basic-input>

              <basic-input
                v-model:keyValue="form.test_stripe_public_key"
                title="Stripe Test Public Key"
                inputName="test_stripe_public_key"
                type="text"
                :cols="6"
                :errors="validator.test_stripe_public_key?.$errors"
                :required="(validator.test_stripe_public_key?.required != undefined)"
              ></basic-input>

              <basic-input
                v-model:keyValue="form.production_stripe_private_key"
                title="Stripe Production Private Key"
                inputName="production_stripe_private_key"
                type="text"
                :cols="6"
                :errors="validator.production_stripe_private_key?.$errors"
                :required="(validator.production_stripe_private_key?.required != undefined)"
              ></basic-input>
    
              <basic-input
                v-model:keyValue="form.test_stripe_private_key"
                title="Stripe Test Private Key"
                inputName="test_stripe_private_key"
                type="text"
                :cols="6"
                :errors="validator.test_stripe_private_key?.$errors"
                :required="(validator.test_stripe_private_key?.required != undefined)"
              ></basic-input>
    
              <basic-input
                v-model:keyValue="form.usd_value"
                title="Valor en Dólares"
                inputName="usd_value"
                type="number"
                :cols="6"
                :errors="validator.usd_value?.$errors"
                :required="(validator.usd_value?.required != undefined)"
              ></basic-input>
    
              <basic-input
                v-model:keyValue="form.eur_value"
                title="Valor en Euros"
                inputName="eur_value"
                type="number"
                :cols="6"
                :errors="validator.eur_value?.$errors"
                :required="(validator.eur_value?.required != undefined)"
              ></basic-input>

          </div>
    
          <template v-if="!method_create">
              <input type="hidden" name="id" :value="form.id" />
          </template>
          <input type="hidden" name="id" :value="1" >
          <input type="hidden" name="_token" :value="csrf" />
          <div class="align-items-center justify-content-center">
          <button type="submit" class="mt-2 btn btn-primary w-100 ">Guardar</button>
          </div>
        </div>  
      </div>     
    </form>
   
    <!-- <p>{{ variables.settings }}</p> -->
  </template>

  
<script>
import BtnOption from '@/Components/BtnOption.vue';
import useValidation from "@/Composables/useValidation.js";
import useBasicCrud from "@/Composables/useBasicCrud.js";
import useRules from "@/Rules/UsersRules.js";
import BasicInput from '@/Components/BasicInput.vue'
import { inject, ref, watch, reactive,onMounted } from 'vue';

export default {
  components: {
    BasicInput,
  },
  props: {
  
    variables : Object
   
  },
  setup(props) {
    const preventDoubleForm = ref(false);
    const method_create = ref(true);
    const formData = {
      google_recaptcha_public_key: '',
      google_recaptcha_private_key: '',
      production_stripe_public_key: '',
      test_stripe_public_key: '',
      usd_value: '',
      eur_value: '',
      email: '',
      production_stripe_private_key: '',
      test_stripe_private_key: '',
      production: '',
    }

    const cleanFormData = {...formData}

    const form = reactive(formData);

    const { rules } = useRules();

    const {
      validator,
      validate
    } = useValidation(rules, form);
    watch(form, () => {
            preventDoubleForm.value = false;
        });
        
    const {
      methods,
    } = useBasicCrud({
      titleBase: 'Configuraciones', 
      form,
      cleanFormData,
      validator,
      validate,
    });

    onMounted(() => {
      if (props.variables && props.variables.settings) {
        Object.assign(form, props.variables.settings);
      }
    });

    return {
      csrf: inject('csrf'),
      form,
      validator,
      method_create,
      methods,
      preventDoubleForm,
    }
  },
};
</script>
