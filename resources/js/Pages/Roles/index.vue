<template>
    <div>
      <basic-table
        :data="variables.roles"
        :tableHeaders="[
          {
            title: 'Perfiles',
            key: 'name',
          },
        ]"
        table_id="rolesTable"
        moduleName="roles"
        
      >
        <template #name="element">
          {{ element.name }}
        </template>
      </basic-table>
    
    </div>
  </template>
<script>
import BasicTable from '@/Components/BasicTable.vue'
import BtnOption from '@/Components/BtnOption.vue'
export default {
    components: {
        BasicTable,
        BtnOption,
    },
    props:{
        variables: Object,
    },
    setup(props){
    }
}
</script>