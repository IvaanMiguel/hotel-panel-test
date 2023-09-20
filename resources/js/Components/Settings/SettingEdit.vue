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

    <!-- Campo para Google reCAPTCHA Public Key -->
    <basic-input
      v-model:keyValue="form.google_recaptcha_public_key"
      title="Google reCAPTCHA Public Key"
      inputName="google_recaptcha_public_key"
      type="text"
      :cols="12"
      :errors="validator.google_recaptcha_public_key?.$errors"
    ></basic-input>

    <!-- Campo para Stripe Production Public Key -->
    <basic-input
      v-model:keyValue="form.strip_production_public_key"
      title="Stripe Production Public Key"
      inputName="strip_production_public_key"
      type="text"
      :cols="12"
      :errors="validator.strip_production_public_key?.$errors"
    ></basic-input>

    <!-- Campo para Stripe Test Public Key -->
    <basic-input
      v-model:keyValue="form.strip_test_public_key"
      title="Stripe Test Public Key"
      inputName="strip_test_public_key"
      type="text"
      :cols="12"
      :errors="validator.strip_test_public_key?.$errors"
    ></basic-input>

    <!-- Campo para el valor en dólares -->
    <basic-input
      v-model:keyValue="form.dollar_value"
      title="Valor en Dólares"
      inputName="dollar_value"
      type="number"
      :cols="12"
      :errors="validator.dollar_value?.$errors"
    ></basic-input>

    <!-- Campo para el valor en euros -->
    <basic-input
      v-model:keyValue="form.euro_value"
      title="Valor en Euros"
      inputName="euro_value"
      type="number"
      :cols="12"
      :errors="validator.euro_value?.$errors"
    ></basic-input>

    <!-- Campo para el correo electrónico de notificaciones -->
    <basic-input
      v-model:keyValue="form.notification_email"
      title="Correo Electrónico de Notificaciones"
      inputName="notification_email"
      type="email"
      :cols="12"
      :errors="validator.notification_email?.$errors"
    ></basic-input>

    <!-- Campo para reCAPTCHA Private Key -->
    <basic-input
      v-model:keyValue="form.google_recaptcha_private_key"
      title="Google reCAPTCHA Private Key"
      inputName="google_recaptcha_private_key"
      type="text"
      :cols="12"
      :errors="validator.google_recaptcha_private_key?.$errors"
    ></basic-input>

    <!-- Campo para Stripe Production Private Key -->
    <basic-input
      v-model:keyValue="form.strip_production_private_key"
      title="Stripe Production Private Key"
      inputName="strip_production_private_key"
      type="text"
      :cols="12"
      :errors="validator.strip_production_private_key?.$errors"
    ></basic-input>

    <!-- Campo para Stripe Test Private Key -->
    <basic-input
      v-model:keyValue="form.strip_test_private_key"
      title="Stripe Test Private Key"
      inputName="strip_test_private_key"
      type="text"
      :cols="12"
      :errors="validator.strip_test_private_key?.$errors"
    ></basic-input>

</app-modal>

</template>

<script>
import BtnOption from '@/Components/BtnOption.vue'
import BasicInput from '@/Components/BasicInput.vue'
export default {
    components: {
        BtnOption,
        BasicInput
    },
    props:{
       
    },
    setup(props){
        const form = {
        google_recaptcha_public_key: '',
        strip_production_public_key: '',
        strip_test_public_key: '',
        dollar_value: '',
        euro_value: '',
        notification_email: '',
        google_recaptcha_private_key: '',
        strip_production_private_key: '',
        strip_test_private_key: ''
        };
        return{
            form
        };
    }
}
</script>