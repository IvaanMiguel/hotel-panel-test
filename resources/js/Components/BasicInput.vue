<template>
    <div :class="`col-md-${cols}`" v-if="type != 'hidden'">
        <div class="mb-4" v-if="type === 'image'">
            <h5 class="fs-14 mb-1">{{ title }} {{ (required ? '*' : '')}}</h5>
            <p class="text-muted"></p>
            <div class="text-center">
                <div class="position-relative d-inline-block mb-4">
                    <div class="position-absolute top-100 start-100 translate-middle">
                        <label :for="inputName" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Subir imagen">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                    <i class="ri-image-fill"></i>
                                </div>
                            </div>
                        </label>
                        <input class="form-control d-none" :name="inputName" :id="inputName" 
                        type="file" accept="image/*" @change="() => {
                            previewImageInput(`${inputName}-img`, inputName)
                            $emit('update:keyValue', 1)
                        }">
                    </div>
                    <div class="avatar-lg">
                        <div class="avatar-title bg-light rounded">
                        <img :src="(keyValue?.full_path ?? '')"
                        :id="`${inputName}-img`" class="avatar-md h-auto" />
                        </div>
                    </div>
                </div>    
                <error-msg v-if="errors"
                    :errors="errors"
                ></error-msg>
            </div>
        </div>
        <div class="vstack gap-2 mb-3" v-else-if="type === 'dropzone'">
            <label>{{ title }}</label>
            <div class="position-relative">
                <drop-zone-area
                    :acceptValue="fileType"
                    :inputName="inputName"
                    :multiple="(Array.isArray(keyValue))"
                    :unique_id="`${inputName}DropZone`"
                ></drop-zone-area>
            </div>
        </div>
        <div class="form-group mb-3" v-else>
            <div class="form-check" v-if="type === 'checkbox'">
                <input class="form-check-input" :true-value="1" :false-value="0" :value="keyValue"
                type="checkbox" @input="$emit('update:keyValue', $event.target.value)" :checked="keyValue"/>
                <label class="form-check-label">{{ title }}</label>
                <input type="hidden" :name="inputName" :value="keyValue">
            </div>
            <template v-else>
                <label>{{title}} {{ (required ? '*' : '')}}</label>
                <select v-if="type == 'select'"
                    :class="`form-control form-select ${(errors?.length>0 ? 'is-invalid' : '')}`"
                    :name="inputName"
                    :value="keyValue"
                    @input="$emit('update:keyValue', $event.target.value)"
                >
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option :value="option[catalogKey]" v-for="(option, index) in catalog" :key="index">
                        {{option[catalogLabel]}}
                    </option>
                </select>
                <template v-else-if="(type == 'multiselect'  && catalog)">
                    <VueMultiselect v-model="multiModel" @click="$emit('update:keyValue', multiModel)"
                        :options="catalog.map(opt => opt[catalogKey])"
                        :multiple="true" :custom-label="opt => catalog.find(x => x[catalogKey] == opt)[catalogLabel]"
                        placeholder="Seleccione una o más opciones" :close-on-select="false"
                        :clear-on-select="false" :preserve-search="true">
                    </VueMultiselect>
                    <template v-for="(value, index) in keyValue" :key="index">
                        <input type="hidden" :name="`${inputName}[${index}][${catalogKey}]`"
                            :value="value">
                    </template>
                </template>
                <textarea v-else-if="type == 'textarea'"
                    :class="`form-control ${(errors?.length>0 ? 'is-invalid' : '')}`"
                    :name="inputName"
                    :value="keyValue"
                    rows="6"
                    @input="$emit('update:keyValue', $event.target.value)"
                ></textarea>
                <input v-else-if="type === 'file'"
                    :class="`form-control ${(errors?.length>0 ? 'is-invalid' : '')}`"
                    type="file"
                    :multiple="(Array.isArray(keyValue))"
                    :name="inputName"
                    :value="keyValue"
                    @change="$emit('update:keyValue', 1)"
                >
                <input v-else
                    :class="`form-control ${(type == 'color' ? 'form-control-color w-100' : '')} 
                    ${(errors?.length>0 ? 'is-invalid' : '')}`"
                    :type="type"
                    :name="inputName"
                    :value="keyValue"
                    :max="maxValue"
                    :min="minValue"
                    @input="$emit('update:keyValue', $event.target.value)"
                >
                <error-msg v-if="errors"
                    :errors="errors"
                ></error-msg>
            </template>
        </div>
    </div>
    <input v-else type="hidden" :name="inputName" :value="keyValue"
        @input="$emit('update:keyValue', $event.target.value)">
</template>

<script>
import VueMultiselect from 'vue-multiselect';
import DropZoneArea from "@/Components/DropZoneArea.vue";
import ErrorMsg from "@/Components/ErrorMsg.vue";
import { onMounted, ref } from 'vue';
export default {
    components: {
        ErrorMsg,
        VueMultiselect,
        DropZoneArea,
    },
    props: {
        title: String,
        inputName: String,
        type: String,
        keyValue: String|Number,
        cols: Number,
        disabled: Boolean,
        errors: Array,
        catalog: Array,
        catalogKey: String,
        catalogLabel: String,
        fileType: String,
        maxValue : String,
        minValue: String, 
        required: {
            type: Boolean,
            default: false
        }
    },
    emits: ['update:keyValue'],
    setup(props){

        const multiModel = ref([]);

        onMounted(() => {
            if(props.type == 'multiselect'){
                multiModel.value = props.keyValue
            }         
        })

        return {
            multiModel
        }
    }
}
</script>
