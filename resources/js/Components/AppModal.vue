<template>
    <div
        class="modal fade"
        :id="modal_id"
        tabindex="-1"
        :aria-labelledby="modal_id"
        aria-hidden="true"
        :data-bs-backdrop="(static_bg ? 'static' : true)"
        role="dialog"
    >
        <div :class="`modal-dialog modal-${size} modal-dialog-centered`">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button
                        class="btn-close"
                        type="button"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <form
                    :action="route(custom_route ?? (base_route + (method_create ? '.create' : '.edit')))"
                    method="POST"
                    enctype="multipart/form-data"
                    @submit="($event) => {$emit('onSubmit', $event); preventDoubleForm = true }"
                    novalidate
                    :target="target"
                >
                    <div class="modal-body">
                        <div class="row">
                            <template v-if="formLayout">
                                <slot v-for="(element) in formLayout" :key="element.key"
                                    :name="element.key" v-bind="element"
                                >
                                    <div :class="`col-md-${element.cols}`" v-if="(element.inputType === 'divider')">
                                        <hr class="border-top-dashed border-2 border-dark mb-4">
                                    </div>
                                    <div :class="`col-md-${element.cols}`" v-else-if="(Array.isArray(element.baseValue) && element.inputType != 'dropzone'
                                        && element.inputType != 'multiselect' && element.inputType != 'file')">
                                        <h4 class="mb-3">{{ element.title }}</h4>
                                        <div class="row">
                                            <div :class="`col-md-${element.elementCols}`" v-for="(arrayElement, arrayIndex) in form[element.key]" :key="arrayIndex">
                                                <div class="row border border-dashed mb-3 m-1 p-1 pt-3">
                                                    <template v-for="(atr, key, index) in element.content" :key="index">
                                                        <basic-input v-if="key != 'none'"
                                                            v-model:keyValue="arrayElement[key]"
                                                            :title="atr.title"
                                                            :fileType="atr.fileType"
                                                            :inputName="`${element.inputName}[${arrayIndex}][${key}]`"
                                                            :type="atr.inputType"
                                                            :cols="atr.cols"
                                                            :catalog="atr.catalog"
                                                            :catalogKey="atr.catalogKey"
                                                            :catalogLabel="atr.catalogLabel"
                                                            :errors="validator[element.key]?.$each?.$response?.$errors[arrayIndex][key]"
                                                            :required="(validator[element.key]?.$each?.$response?.$data[arrayIndex][key]?.required != undefined)"
                                                        ></basic-input>
                                                        <basic-input v-else
                                                            v-model:keyValue="form[element.key][arrayIndex]"
                                                            :title="atr.title"
                                                            :fileType="atr.fileType"
                                                            :inputName="`${element.inputName}[${arrayIndex}]`"
                                                            :type="atr.inputType"
                                                            :cols="atr.cols"
                                                            :catalog="atr.catalog"
                                                            :catalogKey="atr.catalogKey"
                                                            :catalogLabel="atr.catalogLabel"
                                                            :errors="validator[element.key]?.$each?.$response?.$errors[arrayIndex]"
                                                            :required="(validator[element.key]?.$each?.$response?.$data[arrayIndex]?.required != undefined)"
                                                        ></basic-input>
                                                        <template v-if="index==0">
                                                            <div :class="`col-md-${(12-atr.cols)}`">
                                                                <a v-if="arrayIndex==0"
                                                                    :class="`btn btn-primary mt-4 w-100 
                                                                    ${(element.limits[1] > form[element.key].length || element.limits[1] == 0) ? '' : 'disabled'}`" 
                                                                    @click="form[element.key].push((key === 'none' ? element.baseValue[0] : {...element.baseValue[0]}))"
                                                                >
                                                                    +
                                                                </a>
                                                                <a v-else
                                                                    :class="`btn btn-danger mt-4 w-100 
                                                                    ${(element.limits[0] < form[element.key].length || element.limits[0] == 0) ? '' : 'disabled'}`" 
                                                                    @click="form[element.key].splice(arrayIndex, 1)"
                                                                >
                                                                    -
                                                                </a>
                                                            </div>
                                                        </template>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div :class="`col-md-${element.cols}`" v-else-if="(typeof element.baseValue == 'object' && element.baseValue != null && element.inputType != 'dropzone'
                                        && element.inputType != 'multiselect' && element.inputType != 'file')">
                                        <h5 class="mb-4">{{ element.title }}</h5>
                                        <div class="row">
                                            <template v-for="(atr, key, index) in element.content" :key="index">
                                                <basic-input
                                                    v-model:keyValue="form[element.key][key]"
                                                    :title="atr.title"
                                                    :fileType="atr.fileType"
                                                    :inputName="`${element.inputName}[${key}]`"
                                                    :type="atr.inputType"
                                                    :cols="atr.cols"
                                                    :catalog="atr.catalog"
                                                    :catalogKey="atr.catalogKey"
                                                    :catalogLabel="atr.catalogLabel"
                                                    :errors="(validator[element.key] ? validator[element.key][key]?.$errors : [])"
                                                    :required="(validator[element.key] ? (validator[element.key][key]?.required != undefined) : false)"
                                                ></basic-input>
                                            </template>
                                        </div>
                                    </div>
                                    <basic-input v-else
                                        v-model:keyValue="form[element.key]"
                                        :title="element.title"
                                        :fileType="element.fileType"
                                        :inputName="element.inputName"
                                        :type="element.inputType"
                                        :cols="element.cols"
                                        :catalog="element.catalog"
                                        :catalogKey="element.catalogKey"
                                        :catalogLabel="element.catalogLabel"
                                        :errors="validator[element.key]?.$errors"
                                        :required="(validator[element.key]?.required != undefined)"
                                    ></basic-input>
                                    </slot>
                            </template>
                            <slot name="modalBody" v-else/>
                        </div>
                    </div>
                    <div class="modal-footer" v-if="!readOnly">
                            
                        <input type="hidden" name="id" :value="form ? form.id : ''" v-if="!method_create"/>
                        <input type="hidden" name="_method" value="PUT" v-if="method_put"/>
                        <input type="hidden" name="_token" :value="csrf" />
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                            Cerrar
                        </button>
                        <button type="submit" class="btn btn-secondary" 
                            :disabled="(btnSubmit || preventDoubleForm)"
                        >
                            {{btn_label}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import BasicInput from '@/Components/BasicInput.vue'
import { inject, ref, watch } from 'vue';
export default {
    components: {
        BasicInput
    },
    props: {
        modal_id: String,
        base_route: String,
        custom_route: String,
        form: Object,
        formLayout: Array,
        validator: Object,
        title: String,
        readOnly: {
            type: Boolean,
            default: false
        },
        method_create: {
            type: Boolean,
            default: true
        },
        post_edit: {
            type: Boolean,
            default: false
        },
        size: {
            type: String,
            default: 'lg'
        },
        btnSubmit: {
            type: Boolean,
            default: false
        },
        method_put: {
            type: Boolean,
            default: false
        },
        static_bg: {
            type: Boolean,
            default: false
        },
        target: {
            type: String,
            default: '_self'
        },
        btn_label: {
            type: String,
            default: 'Guardar'
        },
    },
    emits: ['onSubmit'],
    setup(props) {
        
        const preventDoubleForm = ref(false)

        if(props.form){
            watch(props.form, (val) => {
                preventDoubleForm.value = false;
            }); 
        }

        return {
            csrf: inject('csrf'),
            preventDoubleForm,
        }
    }
}
</script>
