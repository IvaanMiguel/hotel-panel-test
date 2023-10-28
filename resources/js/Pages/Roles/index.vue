<template>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="row mb-2 g-3 align-items-center">
            <div class="col-md-6">
              <h3>Perfiles</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
              <btn-option :action="{ id: 'roles', method: 'create' }" type="button" color="success" text="Agregar"
              icon="ri-add-fill" v-if="(can('roles.create'))"></btn-option>
            </div>
          </div>
          <div class="row">
            <div class="col-xxl-12 mt-2" v-for="(role, index) in roles" :key="index">
              <div class="accordion custom-accordionwithicon accordion-fill-primary"
                :id="'accordion' + (role.name).replaceAll(' ', '-')">
                <div class="accordion-item">
                  <h2 class="accordion-header" :id="'accordionFill' + (role.name).replaceAll(' ', '-')">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      :data-bs-target="'#accor_fill' + (role.name).replaceAll(' ', '-')" aria-expanded="false"
                      :aria-controls="'accor_fill' + (role.name).replaceAll(' ', '-')">
                      {{ role.name }}
                    </button>
                  </h2>
                  <div :id="'accor_fill' + (role.name).replaceAll(' ', '-')" class="accordion-collapse collapse"
                    :aria-labelledby="'accordionFill' + (role.name).replaceAll(' ', '-')"
                    :data-bs-parent="'#accordion' + (role.name).replaceAll(' ', '-')" style="">
                    <div class="accordion-body">
                      <div class="row gy-4">
                        <div class="col-xl-4 col-md-6" v-for="(permission) in myFilter(role.permissions)"
                          :key="permission.id">
                          <blockquote class="mt-4 blockquote custom-blockquote blockquote-primary rounded mb-0">
                            <p class="text-dark mb-2"> {{ permission }}</p>
                            <template v-for="name in myFilter2(role.permissions, permission)" :key="name.id">
                              <footer class="blockquote-footer mt-0">
                                <cite title="Source Title">{{ name.description }}</cite>
                              </footer>
                            </template>
                          </blockquote>
                        </div>
                      </div>

                      <br>
                      <div class="d-flex hastck gap-2 flex-wrap">
                        <btn-option :action="{ id: 'roles', method: 'edit', params: { id: role.id } }" type="button"
                          color="success" text="Editar" icon="ri-image-edit-line"
                          v-if="(can('roles.update'))"></btn-option>

                        <btn-option :action="{ id: 'roles', method: 'destroy', params: { id: role.id } }" type="button"
                          color="danger" text="Eliminar" icon="ri-delete-bin-5-fill"
                          v-if="(can('roles.destroy'))"></btn-option>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <roles-add-edit :permissions="permissions" />
</template>
<script>
import RolesAddEdit from "@/Components/Roles/RolesAddEdit.vue";
import BtnOption from '@/Components/BtnOption.vue'
import { reactive } from '@vue/reactivity';
export default {
  components: {
    BtnOption,
    RolesAddEdit
  },
  props: {
    roles: Array,
    permissions: Object,
  },
  methods: {
    onlyUnique(value, index, self) {
      return self.indexOf(value) === index;
    },
    myFilter(role) {
      let array = [];
      for (let i = 0; i < role?.length; i++) {
        array.push(role[i].module);
      }
      let unique = array.filter(this.onlyUnique);
      return unique;
    },
    myFilter2(role, val) {
      return role.filter(x => x.module === val);
    },
  },
  setup(props) {
    const roles = reactive(props.roles)
    return {
      roles,
    };
  },
};
</script>
