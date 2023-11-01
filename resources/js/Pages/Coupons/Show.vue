<template>
    <div class='row'>
        <div class='col-md-8'>
            <div class='card'>
                <div class='card-body'>
                    <div class='text-center'>
                        <img class='w-25 mb-2' :src='getAvatar(info.coupon.name)'>
                        <div>
                            <h5>{{ info.coupon.name }}</h5>
                            <span>{{ info.coupon.description }}</span>
                        </div>
                    </div>
                    <div class='table-responsive'>
                        <table class='table mb-0 table-borderless'>
                            <tbody>
                                <tr>
                                    <th class='w-50'>
                                        <span class='fw-medium'>Código</span>
                                    </th>
                                    <td>{{ info.coupon.code }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class='fw-medium'>Hotel</span>
                                    </th>
                                    <td>{{ info.coupon.hotel.name }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class='fw-medium'>Límite de usos</span>
                                    </th>
                                    <td>{{ info.coupon.limit_uses }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class='fw-medium'>Veces usado</span>
                                    </th>
                                    <td>{{ info.coupon.uses_count }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-4'>
            <div class='card'>
                <div class='card-body pb-0'>
                    <div class='table-responsive table-card'>
                        <table class='table'>
                            <thead class='text-muted table-light'>
                                <tr class='text-uppercase'>
                                    <th colspan='2'>Tipo de habitación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='roomType in info.coupon.types'>
                                    <td>{{ roomType.name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class='col'>
            <BasicTable
                read_only
                :data='formatData()'
                :tableHeaders='[
                    {
                        title: "Fecha de inicio",
                        key: "start_date"
                    },
                    {
                        title: "Fecha de fin",
                        key: "end_date"
                    },
                    {
                        title: "Cantidad",
                        key: "amount"
                    },
                    {
                        title: "Cantidad mínima",
                        key: "min_amount"
                    },
                    {
                        title: "¿Porcentaje?",
                        key: "is_percentage"
                    },
                    {
                        title: "Precio por noche",
                        key: "price_per_night"
                    },
                    {
                        title: "Mínimo de noches",
                        key: "min_nights"
                    },
                    {
                        title: "Tipo de cambio",
                        key: "exchange"
                    },
                    {
                        title: "Estado",
                        key: "status"
                    },
                ]'
                moduleName=''
                table_id='couponDataTable'
                :createBtn=false
            />
        </div>
    </div>
</template>

<script setup>
import BasicTable from '@/components/BasicTable.vue'

const props = defineProps({
    info: {
        required: true,
        type: Object
    }
})

const formatData = () => {
    return props.info.coupon.coupon_data.map(couponData => ({
        ...couponData,
        is_percentage: couponData.is_percentage ? 'Sí' : 'No'
    }))
}
</script>
