<template>
  
     <div class="row">
        <div class="col-lg-12">
            <roles-table
                :roles="roles"
                :permissions="permissions"
            >
            </roles-table>
        </div>
    </div>
  </template>
<script>
import RolesTable from '@/Components/Roles/RolesTable.vue'
export default {
    components: {
      RolesTable
    },
    props:{
      roles: Array,
      permissions: Object,
    },
    setup(props){
    }
}
</script>