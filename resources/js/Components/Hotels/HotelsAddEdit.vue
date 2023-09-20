<template>
  <app-modal
    :modal_id="modal_id"
    base_route="hotels"
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
        v-model:keyValue="form.slug"
        title="Slug"
        inputName="slug"
        type="text"
        :cols="6"
        :errors="validator.slug?.$errors"
        :required="(validator.slug?.required != undefined)"
        @focusout="autoSlug"
        @focusin="autoSlug"
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
        @input="limitInputToTenCharacters"
        :cols="6"
        :errors="validator.phone_number?.$errors"
        :required="(validator.phone_number?.required != undefined)"
      ></basic-input>
      <basic-input
        v-model:keyValue="form.address"
        title="Dirección"
        inputName="address"
        type="text"
        :cols="12"
        :errors="validator.address?.$errors"
        :required="(validator.address?.required != undefined)"
      ></basic-input>
      <basic-input
        v-model:keyValue="form.url_address"
        title="Url de dirección"
        inputName="url_address"
        type="text"
        :cols="12"
        :errors="validator.url_address?.$errors"
        :required="(validator.url_address?.required != undefined)"
      ></basic-input>
      <basic-input
        v-model:keyValue="form.cover"
        title="Cover"
        inputName="cover"
        type="file"
        accept=".jpeg"
        :cols="12"
        :errors="validator.cover?.$errors"
        :required="(validator.cover?.required != undefined)"
      ></basic-input>
    </template>
  </app-modal>
</template>

<script>
import AppModal from "@/Components/AppModal.vue";
import useValidation from "@/Composables/useValidation.js";
import useBasicCrud from "@/Composables/useBasicCrud.js";
import hotelsRules from "@/Rules/HotelsRules.js";
import BasicInput from "@/Components/BasicInput.vue";
import ErrorMsg from "@/Components/ErrorMsg.vue";
import { inject, ref, watch, reactive } from "vue";

export default {
  components: {
    AppModal,
    BasicInput,
    ErrorMsg,
  },
  props: {
    modal_id: {
      type: String,
      default: "modalAddHotels",
    },
  },
  setup(props) {
    const method_create = ref(true);

    const formData = {
      id: "",
      name: "",
      email: "",
      slug: "",
      phone_number: "",
      address: "",
      url_address: "",
      cover: "",
    };

    const cleanFormData = { ...formData };

    const form = reactive(formData);

    const { rules } = hotelsRules();

    const { validator, validate } = useValidation(rules, form);

    const { title_modal, methods } = useBasicCrud({
      titleBase: "Hotel",
      form,
      method_create,
      cleanFormData,
      validator,
      validate,
      modal_id: props.modal_id,
      getRoute: "hotels",
      destroyRoute: "hotels",
    });

    const trigger = inject("trigger");

    var emptySlug = true;

    watch(() => form.name, () => {
      if (!form.slug) emptySlug = true;
      if (emptySlug && form.name) form.slug = slugify(form.name);
    });

    watch(() => form.slug, () => {
      if (form.slug?.includes(" ")) {
        form.slug = form.slug?.replaceAll(" ", "-").toLowerCase();
      }
    });

    const autoSlug = () => {
      if (form.slug) emptySlug = false;
    };

    const slugify = (text) => {
      return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, "-")
        .replace(/[^a-z0-9-]/g, "")
        .replace(/-+/g, "-");
    };

    watch(trigger, () => {
      if (trigger.value?.id == "hotels") {
        methods[trigger.value?.method](trigger.value?.params);
      }
    });

    return {
      form,
      validator,
      title_modal,
      method_create,
      methods,
      autoSlug,
      emptySlug,
    };
  },
};
</script>
