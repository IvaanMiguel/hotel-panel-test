<template>
    <div :class="`col-md-${cols}`" v-if="type != 'hidden'">
        <div class="mb-4" v-if="(type === 'image' || type === 'bigImage')">
            <h5 class="fs-14 mb-1">{{ title }} {{ (required ? '*' : '')}}</h5>
            <div class="text-center" v-if="type === 'image'">
                <div class="position-relative d-inline-block mb-4">
                    <div class="position-absolute top-100 start-100 translate-middle">
                        <label :for="inputName" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Subir imagen">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                    <i class="ri-image-fill"></i>
                                </div>
                            </div>
                        </label>
                        <input class="form-control d-none" :name="inputName" :id="inputName" :disabled="disabled ? true : false"
                        type="file" :accept="(fileType ?? 'image/*')" @change="() => {
                            previewImageInput(`${inputName}-img`, inputName)
                            $emit('update:keyValue', 1)
                        }">
                    </div>
                    <div class="avatar-lg">
                        <div class="avatar-title bg-light rounded">
                        <img :src="(keyValue?.full_url ?? '')"
                        :id="`${inputName}-img`" class="avatar-md h-auto" />
                        </div>
                    </div>
                </div>    
                <error-msg v-if="errors"
                    :errors="errors"
                ></error-msg>
            </div>
            <div class="text-center" v-if="type === 'bigImage'">
                <div class="position-relative">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <label :for="inputName" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Subir imagen">
                            <div class="avatar-md">
                                <div class="avatar-title shadow-sm bg-light border rounded-circle text-muted cursor-pointer">
                                    <i class="ri-image-fill display-6"></i>
                                </div>
                            </div>
                        </label>
                        <input class="form-control d-none" :name="inputName" :id="inputName" :disabled="disabled ? true : false"
                        type="file" :accept="(fileType ?? 'image/*')" @change="() => {
                            previewImageInput(`${inputName}-img`, inputName)
                            $emit('update:keyValue', 1)
                        }">
                    </div>
                    <div class="gallery-container d-block">
                        <div class="p-5 bg-light rounded">
                            <img name="cover" :src="(keyValue?.full_url ?? '')"
                        :id="`${inputName}-img`" class="gallery-img img-fluid mx-auto" />
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
                <input class="form-check-input" :true-value="1" :false-value="0" :value="keyValue" :disabled="disabled ? true : false"
                type="checkbox" @click="$emit('update:keyValue', keyValue === 1 ? 0: 1)" :checked="keyValue"/>
                <label class="form-check-label">{{ title }}</label>
                <input type="hidden" :name="inputName" :value="keyValue">
            </div>
            <div class="form-check form-switch form-switch-md" v-else-if="type === 'switch'">
                <input class="form-check-input" :true-value="1" :false-value="0" :value="keyValue" :disabled="disabled ? true : false"
                type="checkbox" role="switch" @click="$emit('update:keyValue', keyValue === 1 ? 0: 1)" :checked="keyValue"/>
                <label class="form-check-label pt-1">{{ title }}</label>
                <input type="hidden" :name="inputName" :value="keyValue">
            </div>
            <template v-else-if="type === 'radio'">
                <label>{{title}} {{ (required ? '*' : '')}}</label>
                <div class="d-flex mt-2">
                    <div class="form-check me-2" v-for="(option, index) in catalog" :key="index">
                        <input class="form-check-input" type="radio" :value="keyValue" :checked="keyValue === (option[catalogKey] ?? option)"
                        @click="$emit('update:keyValue', keyValue === (option[catalogKey] ?? option) ? '': (option[catalogKey] ?? option))"
                        >
                        <label class="form-check-label">
                            {{ (option[catalogLabel] ?? option) }}
                        </label>
                        <input type="hidden" :name="inputName" :value="keyValue">
                    </div>
                </div>
                <error-msg v-if="errors"
                    :errors="errors"
                ></error-msg>
            </template>
            <template v-else>
                <label>{{title}} {{ (required ? '*' : '')}}</label>
                <div class="input-group">
                    <select v-if="type == 'select'"
                        :class="`form-control form-select ${(errors?.length>0 ? 'is-invalid' : '')}`"
                        :name="inputName"
                        :value="keyValue"
                        :disabled="disabled ? true : false"
                        @input="$emit('update:keyValue', $event.target.value)"
                    >
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option :value="(option[catalogKey] ?? option)" v-for="(option, index) in catalog" :key="index">
                            {{ (option[catalogLabel] ?? option) }}
                        </option>
                    </select>
                    <template v-else-if="(type == 'multiselect'  && catalog)">
                        <VueMultiselect v-model="multiModel" @select="$emit('update:keyValue', multiModel)"
                            @remove="$emit('update:keyValue', multiModel)" :multiple="Array.isArray(keyValue)" 
                            :options="catalogKey ? catalog.map(el => el[catalogKey]) : catalog" deselect-label="Quitar" select-label="Seleccionar"
                            selected-label="Seleccionado" :close-on-select="!Array.isArray(keyValue)"  
                            :custom-label="(opt => catalogLabel ? 
                            (catalog.find(el => el[catalogKey] === opt) ? catalog.find(el => el[catalogKey] === opt)[catalogLabel] : opt) : opt)"
                            :placeholder="`Seleccione una ${Array.isArray(keyValue) ? 'o más opciones' : 'opción'}`"
                            :clear-on-select="false" :preserve-search="true"
                        >
                            <template #noOptions>
                                No hay opciones disponibles
                            </template>
                            <template #noResult>
                                No hay resultados que coincidan
                            </template>
                        </VueMultiselect>
                        <template v-if="Array.isArray(keyValue)">
                            <input v-for="(value, index) in keyValue" :key="index"
                                type="hidden" :name="`${inputName}[${index}][${catalogKey}]`"
                                :value="value">
                        </template>
                        <input type="hidden" :name="inputName" :value="keyValue" v-else>
                    </template>
                    <textarea v-else-if="type == 'textarea'"
                        :class="`form-control ${(errors?.length>0 ? 'is-invalid' : '')}`"
                        :name="inputName"
                        :value="keyValue"
                        rows="6"
                        :disabled="disabled ? true : false"
                        @input="$emit('update:keyValue', $event.target.value)"
                    ></textarea>
                    <template v-else-if="type === 'textEditor'">
                        <input type="hidden" :name="inputName" :value="keyValue"/>
                        <Editor api-key="no-api-key" :init="{ plugins: 'lists link image table code help wordcount' }" 
                            v-model="editorModel" @change="$emit('update:keyValue', editorModel)"
                            model-events="change keydown blur focus paste" style="width: 100%;"
                        />                
                    </template>
                    <input v-else-if="type === 'file'"
                        :class="`form-control ${(errors?.length>0 ? 'is-invalid' : '')}`"
                        type="file"
                        :multiple="(Array.isArray(keyValue))"
                        :name="inputName"
                        :disabled="disabled ? true : false"
                        :accept="fileType"
                        @change="$emit('update:keyValue', 1)"
                    >
                    <input v-else
                        :class="`form-control ${(type == 'color' ? 'form-control-color w-100' : '')} 
                        ${(errors?.length>0 ? 'is-invalid' : '')}`"
                        :type="type"
                        :name="inputName"
                        :value="keyValue"
                        :min="minValue"
                        :max="maxValue"
                        :disabled="disabled ? true : false"
                        @input="$emit('update:keyValue', $event.target.value)"
                    >
                    <slot name="inputBtn"/>
                </div>
                <error-msg v-if="errors"
                    :errors="errors"
                ></error-msg>
            </template>
        </div>
    </div>
    <input v-else type="hidden" :name="inputName" :value="keyValue">
</template>

<script>
import Editor from '@tinymce/tinymce-vue'
import VueMultiselect from 'vue-multiselect';
import DropZoneArea from "@/Components/DropZoneArea.vue";
import ErrorMsg from "@/Components/ErrorMsg.vue";
import { onMounted, ref, watch } from 'vue';
export default {
    components: {
        ErrorMsg,
        Editor,
        VueMultiselect,
        DropZoneArea,
    },
    props: {
        title: String,
        inputName: String,
        type: String,
        keyValue: String|Number,
        cols: Number,
        disabled: Number,
        errors: Array,
        catalog: Array,
        catalogKey: String,
        catalogLabel: String,
        fileType: String,
        minValue: String,
        maxValue: String,
        required: {
            type: Boolean,
            default: false
        }
    },
    emits: ['update:keyValue'],
    setup(props){

        const multiModel = ref([]);
        const editorModel = ref('');

        onMounted(() => {
            if(props.type == 'multiselect'){
                multiModel.value = props.keyValue
                watch(() => props.keyValue, () => {
                    if(multiModel.value != props.keyValue) multiModel.value = props.keyValue
                })
            }         
            if(props.type == 'textEditor'){
                editorModel.value = props.keyValue
                watch(() => props.keyValue, () => {
                    if(editorModel.value != props.keyValue) editorModel.value = props.keyValue
                })
            }  
        })

        return {
            multiModel,
            editorModel,
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css" />