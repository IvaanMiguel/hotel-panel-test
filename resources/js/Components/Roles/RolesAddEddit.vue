<template>
    <app-modal
        id="modalAdd"
        route_name="roles"
        :form="form"
        :title_modal="title_modal"
        :method_post="method_post"
        @onSubmit="submitForm($event)"
    >
        <template #modalBody>
            <div class="col-md-12">
                <div class="form-group mb-2" :class="{ error: v.name.$errors.length }">
                    <label for="name">Nombre del perfil *</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        v-model="form.name"
                        class="form-control"
                        required
                    />
                    <error-msg :errors="v.name.$errors"></error-msg>
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
import ErrorMsg from "@/Components/ErrorMsg.vue";
import RolesTable from "./RolesTable.vue";
export default {
  components: {
    AppModal,
    ErrorMsg,
  },
  props: {
    is_modifiable: Boolean,
    form: Object,
    method_post: Boolean,
    permissions: Object,
    title_modal: String,
    submitForm: Function,
    v: Object,
  },
  setup(props){
    return{
    }
  }
};
</script>
