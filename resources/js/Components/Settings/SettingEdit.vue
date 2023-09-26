<template>
  <app-modal
    :modal_id="modal_id"
    base_route="settings"
    :form="form"
    :validator="validator"
    :title="title_modal"
    :method_edit="method_edit"
    @onSubmit="methods.submitForm($event)"

  >
    <div class="container p-4">
      <div class="row">
        <!-- Columna izquierda (cinco campos) -->
        <div class="col-md-6">
          <div class="mb-4">
            <label for="google_recaptcha_public_key" class="form-label">Google recaptcha Public Key</label>
            <input
              :value="form.google_recaptcha_public_key"
              @input="form.google_recaptcha_public_key = $event"
              type="text"
              class="form-control rounded-pill"
              id="google_recaptcha_public_key"
            >
            <div class="invalid-feedback" v-if="validator.google_recaptcha_public_key?.$errors">{{ validator.google_recaptcha_public_key.$errors[0] }}</div>
          </div>

          <div class="mb-4">
            <label for="production_stripe_public_key" class="form-label">Stripe Production Public Key</label>
            <input
              :value="form.production_stripe_public_key"
              @input="form.production_stripe_public_key = $event"
              type="text"
              class="form-control rounded-pill"
              id="production_stripe_public_key"
            >
            <div class="invalid-feedback" v-if="validator.production_stripe_public_key?.$errors">{{ validator.production_stripe_public_key.$errors[0] }}</div>
          </div>

          <div class="mb-4">
            <label for="test_stripe_public_key" class="form-label">Stripe Test Public Key</label>
            <input
              :value="form.test_stripe_public_key"
              @input="form.test_stripe_public_key = $event"
              type="text"
              class="form-control rounded-pill"
              id="test_stripe_public_key"
            >
            <div class="invalid-feedback" v-if="validator.test_stripe_public_key?.$errors">{{ validator.test_stripe_public_key.$errors[0] }}</div>
          </div>

          <div class="mb-4">
            <label for="usd_value" class="form-label">Valor en Dólares</label>
            <input
              :value="form.usd_value"
              @input="form.usd_value = $event"
              type="number"
              class="form-control rounded-pill"
              id="usd_value"
            >
            <div class="invalid-feedback" v-if="validator.usd_value?.$errors">{{ validator.usd_value.$errors[0] }}</div>
          </div>

          <div class="mb-4">
            <label for="eur_value" class="form-label">Valor en Euros</label>
            <input
              :value="form.eur_value"
              @input="form.eur_value = $event"
              type="number"
              class="form-control rounded-pill"
              id="eur_value"
            >
            <div class="invalid-feedback" v-if="validator.eur_value?.$errors">{{ validator.eur_value.$errors[0] }}</div>
          </div>
        </div>

        <!-- Columna derecha (cuatro campos) -->
        <div class="col-md-6">
          <div class="mb-4">
            <label for="email" class="form-label">Correo Electrónico de Notificaciones</label>
            <input
              :value="form.email"
              @input="form.email = $event"
              type="email"
              class="form-control rounded-pill"
              id="email"
            >
            <div class="invalid-feedback" v-if="validator.email?.$errors">{{ validator.email.$errors[0] }}</div>
          </div>

          <div class="mb-4">
            <label for="google_recaptcha_private_key" class="form-label">Google recaptcha Private Key</label>
            <input
              :value="form.google_recaptcha_private_key"
              @input="form.google_recaptcha_private_key = $event"
              type="text"
              class="form-control rounded-pill"
              id="google_recaptcha_private_key"
            >
            <div class="invalid-feedback" v-if="validator.google_recaptcha_private_key?.$errors">{{ validator.google_recaptcha_private_key.$errors[0] }}</div>
          </div>

          <div class="mb-4">
            <label for="production_stripe_private_key" class="form-label">Stripe Production Private Key</label>
            <input
              :value="form.production_stripe_private_key"
              @input="form.production_stripe_private_key = $event"
              type="text"
              class="form-control rounded-pill"
              id="production_stripe_private_key"
            >
            <div class="invalid-feedback" v-if="validator.production_stripe_private_key?.$errors">{{ validator.production_stripe_private_key.$errors[0] }}</div>
          </div>

          <div class="mb-4">
            <label for="test_stripe_private_key" class="form-label">Stripe Test Private Key</label>
            <input
              :value="form.test_stripe_private_key"
              @input="form.test_stripe_private_key = $event"
              type="text"
              class="form-control rounded-pill"
              id="test_stripe_private_key"
            >
            <div class="invalid-feedback" v-if="validator.test_stripe_private_key?.$errors">{{ validator.test_stripe_private_key.$errors[0] }}</div>
          </div>

          <div class="mb-4">
            <label for="production" class="form-label">produccion</label>
            <input
              :value="form.production"
              @input="form.production = $event"
              type="text"
              class="form-control rounded-pill"
              id="production"
            >
            <div class="invalid-feedback" v-if="validator.production?.$errors">{{ validator.production.$errors[0] }}</div>
          </div>
        </div>
      </div>

      <!-- Botón de Guardar centrado debajo de los campos -->
      <!-- <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary rounded-pill">Guardar</button>
      </div> -->
    </div>
  </app-modal>
</template>
<script>
import BtnOption from '@/Components/BtnOption.vue';
import BasicInput from '@/Components/BasicInput.vue';

export default {
  components: {
    BtnOption,
    BasicInput,
  },
  props: {},
  setup(props) {
    const form = {
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
    };
            

    const validator = {
      google_recaptcha_public_key: null,
      google_recaptcha_private_key: null,
      production_stripe_public_key: null,
      test_stripe_public_key: null,
      usd_value: null,
      eur_value: null,
      email: null,
      production_stripe_private_key: null,
      test_stripe_private_key: null,
      production : null
    };

    return {
      form,
      validator,
    };
  },
};
</script>
