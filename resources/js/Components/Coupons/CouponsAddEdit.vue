<template>
    <app-modal
        :modal_id="modal_id"
        base_route="coupons"
        :form="form"
        :validator="validator"
        :title="title_modal"
        :method_put="!method_create"
        :method_create="method_create"
        @onSubmit="methods.submitForm($event)"
    >
        <template #modalBody>
            <basic-input
                v-model:keyValue="form.name"
                title="Nombre"
                inputName="name"
                type="text"
                :cols="12"
                :errors="validator.name?.$errors"
                :required="(validator.name?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.description"
                title="Descripción"
                inputName="description"
                type="textarea"
                :cols="9"
                :errors="validator.description?.$errors"
                :required="(validator.description?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.image"
                title="Imagen"
                inputName="image"
                type="image"
                :cols="3"
                :errors="validator.image?.$errors"
                :required="(validator.image?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.code"
                title="Código"
                inputName="code"
                type="text"
                :cols="12"
                :errors="validator.code?.$errors"
                :required="(validator.code?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.coupon_data[0].start_date"
                title="Fecha de inicio"
                inputName="start_date"
                type="date"
                :minValue="form.current_date || currentDate"
                :cols="6"
                :errors="validator.coupon_data[0].start_date?.$errors"
                :required="(validator.coupon_data[0].start_date?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.coupon_data[0].end_date"
                title="Fecha de fin"
                inputName="end_date"
                type="date"
                :minValue="form.coupon_data[0].start_date || currentDate"
                :cols="6"
                :errors="validator.coupon_data[0].end_date?.$errors"
                :required="(validator.coupon_data[0].end_date?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.coupon_data[0].is_percentage"
                title="¿Es porcentaje?"
                inputName="is_percentage"
                type="radio"
                :catalog="percentageOptions"
                catalogKey="value"
                catalogLabel="label"
                :cols="6"
                :errors="validator.coupon_data[0].is_percentage?.$errors"
                :required="(validator.coupon_data[0].is_percentage?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.coupon_data[0].amount"
                title="Cantidad"
                inputName="amount"
                type="number"
                :cols="6"
                :errors="validator.coupon_data[0].amount?.$errors"
                :required="(validator.coupon_data[0].amount?.required != undefined)"
            />
            <!-- Se deben implementar radio buttons para esta opción. -->
            <basic-input
                v-model:keyValue="form.coupon_data[0].exchange"
                title="TIpo de cambio"
                inputName="exchange"
                type="text"
                :cols="6"
                :errors="validator.coupon_data[0].exchange?.$errors"
                :required="(validator.coupon_data[0].exchange?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.coupon_data[0].min_amount"
                title="Cantidad mínima"
                inputName="min_amount"
                type="numeric"
                :cols="6"
                :errors="validator.coupon_data[0].min_amount?.$errors"
                :required="(validator.coupon_data[0].min_amount?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.coupon_data[0].min_nights"
                title="Mínimo de noches"
                inputName="min_nights"
                type="number"
                :cols="6"
                :errors="validator.coupon_data[0].min_nights?.$errors"
                :required="(validator.coupon_data[0].min_nights?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.limit_uses"
                title="Límite de usos"
                inputName="limit_uses"
                type="number"
                :cols="6"
                :errors="validator.limit_uses?.$errors"
                :required="(validator.limit_uses?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.hotel_id"
                title="Hotel"
                inputName="hotel_id"
                type="select"
                :catalog = "hotels"
                catalogKey ="id"
                catalogLabel ="name"
                :cols="12"
                :errors="validator.hotel_id?.$errors"
                :required="(validator.hotel_id?.required != undefined)"
            />
            <basic-input
                v-model:keyValue="form.types[0].id"
                title="Tipo de habitación"
                inputName="type_ids"
                type="select"
                :catalog = "types"
                catalogKey ="id"
                catalogLabel ="name"
                :cols="12"
                :errors="validator.types[0].id?.$errors"
                :required="(validator.types[0].id?.required != undefined)"
            ></basic-input>
            <basic-input
                v-model:keyValue="form.coupon_data[0].status"
                title="Estado"
                inputName="status"
                type="select"
                :catalog = "statusOptions"
                catalogKey ="value"
                catalogLabel ="label"
                :cols="12"
                :errors="validator.coupon_data[0].status?.$errors"
                :required="(validator.coupon_data[0].status?.required != undefined)"
            ></basic-input>
        </template>
    </app-modal>
</template>

<script setup>
import { inject, reactive, ref, watch, watchEffect } from 'vue'

import AppModal from "@/Components/AppModal.vue"
import BasicInput from '@/Components/BasicInput.vue'

import useValidation from "@/Composables/useValidation.js"
import useBasicCrud from "@/Composables/useBasicCrud.js"
import useRules from "@/Rules/CouponsRules.js"

const props = defineProps({
    modal_id: {
        type: String,
        default: 'modalAddCoupons'
    },
    hotels: {
        type: Array,
        required: true
    },
    types: {
        type: Array,
        required: true
    },
    currentDate : {
        type: String,
        required: true
    }
})

const statusOptions = [
    { label: "Activo", value: 'Activo' },
    { label: "Inactivo", value: 'Inactivo' }
]
const percentageOptions = [
    { label: "Sí", value: 1 },
    { label: "No", value: 0 },
]

const method_create = ref(true)

const formData = {
    id: "",
    name: "",
    description: "",
    image: "",
    code: "",
    coupon_data: [{
        start_date: "",
        end_date: "",
        amount: "",
        is_percentage: "",
        exchange: "",
        min_amount: "",
        min_nights: "",
        status: ""
    }],
    min_amount: "",
    min_nights: "",
    limit_uses: "",
    hotel_id: "",
    types: [{ id: "" }]
}
const cleanFormData = { ...formData }
const form = reactive(formData);

const { rules } = useRules();
const { validator, validate } = useValidation(rules, form);
const { title_modal, methods } = useBasicCrud({
    titleBase: "Cupones",
    form,
    method_create,
    cleanFormData,
    validator,
    validate,
    modal_id: props.modal_id,
    getRoute: "coupons",
    destroyRoute: "coupons"
});

const trigger = inject("trigger");

watch(trigger, () => {
    if (trigger.value?.id !== "coupons") return

    methods[trigger.value?.method](trigger.value?.params)
})

watchEffect(() => {
    form.coupon_data[0].end_date = form.coupon_data[0].start_date > form.coupon_data[0].end_date
        ? form.coupon_data[0].start_date
        : form.coupon_data[0].end_date
})
</script>
