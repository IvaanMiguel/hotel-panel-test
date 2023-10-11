
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
            <!-- Columna izquierda (cinco campos) -->
            <div class="col-md-6">
              <div class="mb-4">
                <label for="google_recaptcha_public_key" class="form-label">Google recaptcha Public Key</label>
                <input
                  v-model="form.google_recaptcha_public_key"
                  type="text"
                  class="form-control "
                  id="google_recaptcha_public_key"
                  name="google_recaptcha_public_key"
                >
                <!-- <div class="invalid-feedback" v-if="validator.google_recaptcha_public_key?.$errors">{{ validator.google_recaptcha_public_key.$errors[0] }}</div> -->
              </div>
    
              <div class="mb-4">
                <label for="production_stripe_public_key" class="form-label">Stripe Production Public Key</label>
                <input
                  v-model="form.production_stripe_public_key "
                  type="text"
                  class="form-control "
                  id="production_stripe_public_key"
                  name="production_stripe_public_key"
                >
                <!-- <div class="invalid-feedback" v-if="validator.production_stripe_public_key?.$errors">{{ validator.production_stripe_public_key.$errors[0] }}</div> -->
              </div>
    
              <div class="mb-4">
                <label for="test_stripe_public_key" class="form-label">Stripe Test Public Key</label>
                <input
                  v-model="form.test_stripe_public_key "
                  type="text"
                  class="form-control "
                  id="test_stripe_public_key"
                  name="test_stripe_public_key"
                >
                <!-- <div class="invalid-feedback" v-if="validator.test_stripe_public_key?.$errors">{{ validator.test_stripe_public_key.$errors[0] }}</div> -->
              </div>
    
              <div class="mb-4">
                <label for="usd_value" class="form-label">Valor en Dólares</label>
                <input
                  v-model="form.usd_value "
                  type="number"
                  class="form-control "
                  id="usd_value"
                  name="usd_value"
                >
                <!-- <div class="invalid-feedback" v-if="validator.usd_value?.$errors">{{ validator.usd_value.$errors[0] }}</div> -->
              </div>
    
              <div class="mb-4">
                <label for="eur_value" class="form-label">Valor en Euros</label>
                <input
                  v-model="form.eur_value "
                  type="number"
                  class="form-control "
                  id="eur_value"
                  name="eur_value"
                >
                <!-- <div class="invalid-feedback" v-if="validator.eur_value?.$errors">{{ validator.eur_value.$errors[0] }}</div> -->
              </div>
            </div>
    
            <!-- Columna derecha (cuatro campos) -->
            <div class="col-md-6">
              <div class="mb-4">
                <label for="email" class="form-label">Correo Electrónico de Notificaciones</label>
                <input
                  v-model="form.email "
                  type="email"
                  class="form-control "
                  id="email"
                  name="email"
                >
                <!-- <div class="invalid-feedback" v-if="validator.email?.$errors">{{ validator.email.$errors[0] }}</div> -->
              </div>
    
              <div class="mb-4">
                <label for="google_recaptcha_private_key" class="form-label">Google recaptcha Private Key</label>
                <input
                  v-model="form.google_recaptcha_private_key "
                  type="text"
                  class="form-control "
                  id="google_recaptcha_private_key"
                  name="google_recaptcha_private_key"
                >
                <!-- <div class="invalid-feedback" v-if="validator.google_recaptcha_private_key?.$errors">{{ validator.google_recaptcha_private_key.$errors[0] }}</div> -->
              </div>
    
              <div class="mb-4">
                <label for="production_stripe_private_key" class="form-label">Stripe Production Private Key</label>
                <input
                  v-model="form.production_stripe_private_key "
                  type="text"
                  class="form-control "
                  id="production_stripe_private_key"
                  name="production_stripe_private_key"
                >
                <!-- <div class="invalid-feedback" v-if="validator.production_stripe_private_key?.$errors">{{ validator.production_stripe_private_key.$errors[0] }}</div> -->
              </div>
    
              <div class="mb-4">
                <label for="test_stripe_private_key" class="form-label">Stripe Test Private Key</label>
                <input
                  v-model="form.test_stripe_private_key "
                  type="text"
                  class="form-control "
                  id="test_stripe_private_key"
                  name="test_stripe_private_key"
                >
                <!-- <div class="invalid-feedback" v-if="validator.test_stripe_private_key?.$errors">{{ validator.test_stripe_private_key.$errors[0] }}</div> -->
              </div>
    
              <div class="mb-4">
                <label for="production" class="form-label">Producción</label>
                <input
                  v-model="form.production "
                  type="text"
                  class="form-control "
                  id="production"
                  name="production"
                >
                <div class="invalid-feedback" v-if="validator.production?.$errors">{{ validator.production.$errors[0] }}</div>
              </div>
            </div>
          </div>
    
          <template v-if="!method_create">
              <input type="hidden" name="id" :value="form.id" />
          </template>
          <input type="hidden" name="id" :value="1" >
          <input type="hidden" name="_token" :value="csrf" />
          <div class="align-items-center justify-content-center">
          <button type="submit" class="btn btn-primary w-100 ">Guardar</button>
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
