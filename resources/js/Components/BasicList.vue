<template>
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="search-box">
                <input type="text" class="form-control search" placeholder="Buscar..." v-model="searchString">
                <i class="ri-search-line search-icon"></i>
            </div>
        </div>
        <div class="col-md-auto ms-auto d-flex" v-if="!read_only">
            <slot name="headerActions"/>
            <btn-option
                :action="{id: moduleName, method: 'create'}"
                type="button"
                color="success"
                text="Agregar"
                icon="ri-add-line"
                v-if="(can(moduleName + '.create') && createBtn)"
            ></btn-option>
        </div>
    </div>
    <div class="row" v-if="pages[selectedPage.value]?.length > 0">
        <template v-for="element in pages[selectedPage.value]" :key="element.id">
            <slot name="content" v-bind="element"/>
        </template>
    </div>
    <div v-else>
        <div class="text-center">
            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
            <h5 class="mt-2">Sin resultados</h5>
            <p class="text-muted mb-0">Ningún registro coincide con la busqueda</p>
        </div>
    </div>
    <div class="row mt-4 mb-3">
        <div class="col-6">
            <div>
                <p class="mb-sm-0 text-muted">Mostrando <span class="fw-semibold">
                    {{pages[selectedPage.value]?.length ?? 0}}</span> de 
                    <span class="fw-semibold text-decoration-underline">{{data.length}}</span> resultados</p>
            </div>
        </div>
        <div class="col-6">
            <ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                <li class="page-item" v-if="selectedPage.value > 0">
                    <a role="button" @click="selectPage(selectedPage.value - 1)" class="page-link">Anterior</a>
                </li>
                <li class="page-item" v-else>
                    <a class="page-link disabled">Anterior</a>
                </li>
                <li class="page-item" v-for="(page, index) in pages" :key="index">
                    <a role="button" @click="selectPage(index)" 
                    class="page-link" :class="index==selectedPage.value ? 'active' : ''">{{index+1}}</a>
                </li>
                <li class="page-item"  v-if="selectedPage.value < pages.length - 1">
                    <a role="button" @click="selectPage(selectedPage.value + 1)" class="page-link">Siguiente</a>
                </li>
                <li class="page-item" v-else>
                    <a class="page-link disabled">Siguiente</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { reactive, computed, watch, ref } from 'vue';
import BtnOption from '@/Components/BtnOption.vue'
  export default {
    components: {
        BtnOption
    },
    props: {
        title: String,
        moduleName: String,
        data: Array,
        read_only: {
            type: Boolean,
            default: false
        },
        createBtn: {
            type: Boolean,
            default: true
        },
        numberPerPage: {
            type: Number,
            default: 12
        },
    },
    setup(props) {

        const searchString = ref('');
        const data = reactive(props.data);
        const selectedPage = reactive({value: 0});

        const pages = computed(() =>{

            var container = [];

            for (let i = 0; i < filter(data).length; i += props.numberPerPage) {
                container.push(filter(data).slice(i, i + props.numberPerPage));
            }

            return container;
        });

        const filter = (array) => {
            return array.filter((element) =>{
                
                var checkFilters = true;

                if(searchString.value.length > 0){

                    checkFilters = false
                    
                    for (const key in element) {
                        let checkKey

                        if(key == 'current_language'){
                            for (const languageKey in element[key]) {
                                checkKey = `${element[key][languageKey]}`

                                if(checkKey.toUpperCase().includes(searchString.value.toUpperCase())) checkFilters = true
                            }
                        }
                        else{
                            checkKey = `${element[key]}`
                            if(checkKey.toUpperCase().includes(searchString.value.toUpperCase())) checkFilters = true
                        }
                    }
                }

                return checkFilters;
            });
        }

        watch(searchString, (newVal) =>{
            Object.assign(selectedPage, {value: 0});
        });
      
        const selectPage = (index) =>{
            Object.assign(selectedPage, {value: index});
        }

        return {
            data,
            selectedPage,
            pages,
            selectPage,
            filter,
            searchString,
        };
    },
  };
  </script>