<template>
    <div class="card">
        <div class='card-header'>
            <div class='d-flex justify-content-end'>
                <BtnOption
                    type="button"
                    color="success"
                    icon="ri-add-line"
                    text="Agregar"
                    :action="{ id: 'coupons', method: 'create' }"
                />
            </div>
        </div>
        <div class='card-body d-flex gap-3 flex-wrap justify-content-around'>
            <CouponCard v-for="coupon in variables.coupons"
                :coupon='{ ...coupon, hotel_name: getHotelNameById(coupon.hotel_id) }'
            />
        </div>
    </div>
    <CouponsAddEdit :hotels='variables.hotels' :types='variables.types' :currentDate='variables.currentDate' />
</template>

<script setup>
import BtnOption from "../../Components/BtnOption.vue";
import CouponCard from "../../Components/Coupons/CouponCard.vue";
import CouponsAddEdit from "../../Components/Coupons/CouponsAddEdit.vue"

const props = defineProps({
    variables: {
        required: true,
        type: Object
    }
})

const getHotelNameById = id => props.variables.hotels.find(hotel => hotel.id === id).name
</script>
