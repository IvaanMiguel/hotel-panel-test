<template>
    <div class="card" :id="`${table_id}List`">
        <template v-if="title">
            <div class="card-header  border-0">
            <div class="d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">{{ title }}</h5>
                <div class="col-md-auto ms-auto d-flex" v-if="!read_only">
                    <slot name="headerActions" />
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
        </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <form>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Buscar..."
                                v-model="searchString">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </template>
        <div class="card-header" v-else>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="search-box">
                        <input type="text" class="form-control search" placeholder="Buscar...">
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
        </div>
        <div class="card-body pt-0">
            <div> 
                <div class="table-responsive table-card my-3">
                    <table class="table table-nowrap align-middle" id="orderTable">
                        <thead class="text-muted table-light">
                            <tr class="text-uppercase">
                                <th v-for="header in tableHeaders" :key="header.key"
                                    class="sort" :data-sort="header.key">{{ header.title }}
                                </th>
                                <th class="sort" style="width: 100px;" v-if="!read_only">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            <tr v-for="(element, index) in data" :key="index" :class="rowClass(element)">

                                <template v-for="header in tableHeaders" :key="header.key">
                                    <td :class="header.key" v-show="!header.hiddenRow">
                                        <template v-if="header.key === 'created_at'">
                                            {{ formatDateHourTextFull(element[header.key]) }}
                                        </template>
                                        <slot :name="header.key"
                                            v-bind="element"
                                            v-else
                                        >
                                            <span :class="(header.dataStyle ? header.dataStyle(element) : '')">
                                                {{ (header.dataFormat ? header.dataFormat(element) : element[header.key]) }}
                                            </span>
                                        </slot>
                                    </td>
                                </template>
                                <td v-if="!read_only">
                                    <btn-option
                                        :action="{id: moduleName, method: 'edit', params: {id: element.id}}"
                                        type="listButton"
                                        color="success"
                                        text="Editar"
                                        icon="ri-pencil-fill"
                                        v-if="(can(moduleName +'.update') && editBtn)"
                                    ></btn-option>
                                    <btn-option
                                        :action="{id: moduleName +'', method: 'destroy', params: {id: element.id}}"
                                        type="listButton"
                                        color="danger"
                                        text="Eliminar"
                                        icon="ri-delete-bin-5-fill"
                                        v-if="(can(moduleName +'.destroy') && destroyBtn)"
                                    ></btn-option>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div :class="`noResult-${table_id}`" style="display: none">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                            <h5 class="mt-2">Sin resultados</h5>
                            <p class="text-muted mb-0">Ningún registro coincide con la busqueda</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <div class="pagination-wrap hstack gap-2">
                        <ul class="pagination listjs-pagination mb-0" onclick="return false;"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BtnOption from '@/Components/BtnOption.vue'
import useFormat from '@/Composables/useFormat.js'
import { onMounted } from 'vue';
export default {
    components: {
        BtnOption
    },
    props: {
        data: Array,
        tableHeaders: Array,
        title: String,
        moduleName: String,
        read_only: {
            type: Boolean,
            default: false
        },
        table_id: {
            type: String,
            default: 'basicTable'
        },
        createBtn: {
            type: Boolean,
            default: true
        },
        detailsBtn: {
            type: Boolean,
            default: false
        },
        editBtn: {
            type: Boolean,
            default: true
        },
        destroyBtn: {
            type: Boolean,
            default: true
        },
        rowClass: {
            type: Function,
            default: (row) => {
                return ''
            }
        },
    },
    setup(props) {

        onMounted(() => {
            if(props.data.length > 0){
                var options = {
                    valueNames: props.tableHeaders.map((header) => { return header.key}),
                    page: 10,
                    pagination: true,
                    plugins: [ListPagination({ left: 2, right: 2 })],
                };

                new List(`${props.table_id}List`, options).on("updated", function (e) {
                    0 == e.matchingItems.length
                    ? (document.getElementsByClassName(`noResult-${props.table_id}`)[0].style.display = "block")
                    : (document.getElementsByClassName(`noResult-${props.table_id}`)[0].style.display = "none");
                });
            }
        });

        const { formatDateHourTextFull } = useFormat();

        return{
            formatDateHourTextFull,
        }
    },
};
</script>