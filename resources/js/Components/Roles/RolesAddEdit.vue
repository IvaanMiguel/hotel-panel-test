<template>
    <app-modal
      :modal_id="modal_id"
      base_route="roles"
      :form="form"
      :validator="validator"
      :title="title_modal"
      :method_put="!method_create"
      :method_create="method_create"
      @onSubmit="methods.submitForm($event)"
    >
        <template #modalBody>
            <div class="col-md-12">
                <div class="form-group mb-2">
                    <label for="name">Nombre del perfil *</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        v-model="form.name"
                        class="form-control"
                        :errors="validator.name?.$errors"
                        :required="(validator.name?.required != undefined)"
                    />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <div class="row px-2    "
                    v-for="(permissionModule, index) in Object.values(permissions)" :key="index">

                        <div class="col-md-12">
                            <br>
                            <h4 class="bg-light p-1">{{Object.keys(permissions)[index]}}</h4>
                        </div>
                        <div
                            class="col-md-6"
                            v-for="(permission, permissionIndex) in permissionModule" :key="permissionIndex"
                        >
                            <div class="form-check mt-2">
                                <input
                                name="permissions[]"
                                    class="form-check-input"
                                    type="checkbox"
                                    :id="'check' + permission.id"
                                    :value="permission.id"
                                    :v-model="form.permissions"
                                    :checked="form.permissions.includes(permission.name)"
                                    :errors="validator.permissions?.$errors"
                                    :required="(validator.permissions?.required != undefined)"
                                >
                                <label class="form-check-label" :for="'check' + permission.id">
                                {{permission.description}}</label>
                            </div>
                        </div>
                        <div class="border border-dashed mt-3"></div>
                    </div>
                </div>
            </div>
        </template>
    </app-modal>
</template>
  
<script>
import AppModal from "@/Components/AppModal.vue";
import useValidation from "@/Composables/useValidation.js";
import useBasicCrud from "@/Composables/useBasicCrud.js";
import useRules from "@/Rules/RolesRules.js";
import BasicInput from '@/Components/BasicInput.vue'
import { inject, ref, watch, reactive } from "vue";

export default {
    components: {
        AppModal,
    },
    props: {
        modal_id: {
            type: String,
            default: "modalAddRoles"
        },
        permissions: Object,
    },
    setup(props) {
        const method_create = ref(true);

        
        const formData = {
            id: "",
            name: "",
            permissions: [{}],
        };

        const cleanFormData = { ...formData };

        const form = reactive(formData);

        const { rules } = useRules();

        const { validator, validate } = useValidation(rules, form);

        const { title_modal, methods } = useBasicCrud({
            titleBase: "Roles",
            form,
            method_create,
            cleanFormData,
            validator,
            validate,
            modal_id: props.modal_id,
            getRoute: "roles",
            destroyRoute: "roles"
        });

        const trigger = inject("trigger");

        watch(trigger, () => {
            if (trigger.value?.id == "roles") {
                methods[trigger.value?.method](trigger.value?.params);
            }
        });

        return {
            form,
            validator,
            title_modal,
            method_create,
            methods
        };
    }
};
</script>
  