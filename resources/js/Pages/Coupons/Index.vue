<template>
    <div id="coupons-list" class="mb-4">
        <div class="card">
            <div class="card-header">
                <div class="row g-0">
                    <div class="col-sm-4 d-flex align-items-center">
                        <div class="search-box flex-grow-1 m-1">
                            <input
                                class="form-control search"
                                type="text"
                                placeholder="Buscar..."
                            >
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <div class="col-auto ms-auto">
                        <BtnOption
                            type="button"
                            color="success"
                            icon="ri-add-line"
                            text="Agregar"
                            :action="{ id: 'coupons', method: 'create' }"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-5 justify-content-around list">
            <CouponCard v-for="coupon in variables.coupons"
                :coupon='{ ...coupon, hotel_name: getHotelNameById(coupon.hotel_id) }'
            />
        </div>
        <div class="card no-coupons-found" style='display: none;'>
            <div class="card-body text-center">
                <lord-icon
                    src="https://cdn.lordicon.com/msoeawqm.json"
                    trigger="loop"
                    colors="primary:#121331,secondary:#08a88a"
                    style="width:75px;height:75px"
                />
                <h5 class="mt-2">
                    Sin resultados
                </h5>
                <p class="text-muted mb-0">
                    Ningún registro coincide con la búsqueda.
                </p>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <div class="pagination-wrap hstack gap-2">
                <ul class="pagination listjs-pagination mb-0" onclick="return false;"></ul>
            </div>
        </div>
    </div>
    <CouponsAddEdit
        :hotels='variables.hotels'
        :types='variables.types'
        :currentDate='variables.currentDate'
    />
</template>

<script setup>
import { onMounted } from 'vue'

import BtnOption from "../../Components/BtnOption.vue";
import CouponCard from "../../Components/Coupons/CouponCard.vue";
import CouponsAddEdit from "../../Components/Coupons/CouponsAddEdit.vue"

const props = defineProps({
    variables: {
        required: true,
        type: Object
    }
})

console.log(props.variables);

const couponKeys = ["name", "hotel_name", "code"]

const getHotelNameById = id => props.variables.hotels.find(hotel => hotel.id === id).name

onMounted(() => {
    let options = {
        valueNames: couponKeys,
        page: 12,
        pagination: true,
        plugins: [ListPagination({ left: 2, right: 2 })],
    }

    new List("coupons-list", options)
        .on("updated", e => {
            document.querySelector(".no-coupons-found").style.display = !e.matchingItems.length ? 'block' : 'none'
        })
})
</script>
