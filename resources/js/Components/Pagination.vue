<template>
    <div class="col-sm-6">
        <div>
            <p class="mb-sm-0 text-muted">Mostrando <span class="fw-semibold">
                {{pages[selectedPage.value]?.length ?? 0}}</span> de 
                <span class="fw-semibold text-decoration-underline">{{count}}</span> resultados</p>
        </div>
    </div>
    <div class="col-sm-6">
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
</template>

<script>
  export default {
    components: {
    },
    props: {
        pages : Array,
        count: Number,
        selectedPage: Object,
    },
    setup(props) {

        const selectPage = (index) =>{
            Object.assign(props.selectedPage, {value: index});
        }

        return {
            selectPage,
        };
    },
  };
  </script>