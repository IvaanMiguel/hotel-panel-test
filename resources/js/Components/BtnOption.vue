<template>
    <a @click="triggerAction(action)" role="button" :class="`btn btn-${color} m-1`" v-if="type === 'button'"
        :href="btnRoute">
        <i :class="`${icon} align-bottom me-1`"></i> {{text}} 
    </a>
    <li class="list-inline-item" data-bs-toggle="tooltip"  v-if="type === 'listButton'" 
        data-bs-trigger="hover" data-bs-placement="top" :title="text" @click="triggerAction(action)"
    >
        <a :class="`text-${color} d-inline-block`" role="button" :href="btnRoute">
            <i :class="`${icon} fs-16`"></i>
        </a>
    </li>
    <a  @click="triggerAction(action)" role="button" class="dropdown-item" v-if="type === 'dropdownButton'"
       :href="btnRoute">
        <i :class="`text-${color} ${icon} align-bottom me-2`"></i> {{text}}
    </a>  
    <form role="button" class="dropdown-item" :action="btnRoute" method="POST" v-if="type === 'dropdownFormButton'">
        <button type="submit" :class="`text-${color}`"
        style="color: transparent; background-color: transparent; border-color: transparent;">
            <i :class="`${icon} align-bottom me-2 ms-n2`"></i> {{ text }}
        </button>
                     
        <input v-for="(param, key, index) in formParams"
            type="hidden" :name="key" :value="param" 
            :key="index"
        />                

        <input type="hidden" name="_token" :value="csrf" /> 
        <input type="hidden" name="_method" value="PUT" v-if="putMethod"/>  
    </form>                                      
    <form :action="btnRoute" method="POST" v-if="type === 'formButton'">
        <button type="submit" :class="`m-1 btn btn-${color}`">
            <i :class="`${icon} align-bottom me-1`"></i> {{ text }}
        </button>
                     
        <input v-for="(param, key, index) in formParams"
            type="hidden" :name="key" :value="param" 
            :key="index"
        />                

        <input type="hidden" name="_token" :value="csrf" /> 
        <input type="hidden" name="_method" value="PUT" v-if="putMethod"/>  
    </form>
    <li class="list-inline-item" data-bs-toggle="tooltip" v-if="type === 'listFormButton'" 
    data-bs-trigger="hover" data-bs-placement="top" :title="text">
        <form :action="btnRoute" method="POST">
            <button type="submit" :class="`text-${color} d-inline-block`"
            style="color: transparent; background-color: transparent; border-color: transparent;">
                <i :class="`${icon} fs-16`"></i>
            </button>             

            <input v-for="(param, key, index) in formParams"
                type="hidden" :name="key" :value="param" 
                :key="index"
            />                

            <input type="hidden" name="_token" :value="csrf" /> 
            <input type="hidden" name="_method" value="PUT" v-if="putMethod"/>       
        </form>
    </li>    
</template>

<script>
import { inject } from 'vue'
export default {
    props: {
        text: String,
        type: String,
        icon: String,
        color: String,
        disabled: Boolean,
        btnRoute: String,
        putMethod: Boolean,
        formParams: Array,
        action: Object,
    },
    setup(props){

        const trigger = inject('trigger');

        const triggerAction = ({id, method, params}) => {
            if(id){
                trigger.value = {
                    id: id,
                    method: method,
                    params: {...params},
                }
            }
        }

        return {
            csrf: inject('csrf'),
            triggerAction,
        }
    }
}
</script>
