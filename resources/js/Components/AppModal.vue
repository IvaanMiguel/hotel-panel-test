<template>
    <div
        class="modal fade"
        :id="id"
        tabindex="-1"
        :aria-labelledby="id"
        aria-hidden="true"
        :data-bs-backdrop="(static_bg ? (static_bg === true ? 'static' : true) : true)"
        role="dialog"
    >
        <div :class="`modal-dialog modal-${size} modal-dialog-centered`">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" :id="id">{{ title_modal }}</h5>
                    <button
                        class="btn-close"
                        type="button"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <form
                    :action="route(route_name + (custom_route ? '' : (method_post ? '.store' : '.edit')))"
                    :method="method"
                    class="needs-validation"
                    enctype="multipart/form-data"
                    @submit="($event) => {$emit('onSubmit', $event); preventDoubleForm = true }"
                    novalidate
                >
                    <div class="modal-body">
                        <div class="row">
                            <slot name="modalBody"></slot>
                        </div>
                    </div>
                    <div class="modal-footer"  v-if="!readOnly">
                        <div v-if="!method_post">
                            <input type="hidden" name="id" :value="form ? form.id : ''" />
                            <div v-if="!post_edit">
                                <input type="hidden" name="_method" value="PUT" />
                            </div>
                        </div>
                        <slot name="hidden"></slot>
                        <input type="hidden" name="_token" :value="csrf" />
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-secondary" :class="{'not-allowed': (btnSubmit || preventDoubleForm)}" 
                        :disabled="(btnSubmit || preventDoubleForm)">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { inject, ref, watch } from 'vue';
export default {
    props: {
        id: String,
        route_name: String,
        form: Object,
        title_modal: String,
        readOnly: {
            type: Boolean,
            default: false
        },
        method_post: {
            type: Boolean,
            default: true
        },
        custom_route: {
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
        method: {
            type: String,
            default: 'POST'
        },
        static_bg: {
            type: Boolean,
            default: false
        },
        post_edit: {
            type: Boolean,
            default: false
        },
    },
    emits: ['onSubmit'],
    setup(props) {
        
        const preventDoubleForm = ref(false)

        watch(props.form, (val) => {
            preventDoubleForm.value = false;
        });

        return {
            csrf: inject('csrf'),
            preventDoubleForm,
        }
    }
}
</script>

<style scoped>
.not-allowed {
    cursor: not-allowed;
}
</style>
