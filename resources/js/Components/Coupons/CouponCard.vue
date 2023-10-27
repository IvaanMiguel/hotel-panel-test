<template>
	<a @click='checkButtonPressed' :href='route("coupons.show", coupon.id)'>
		<div class='card overflow-hidden mb-0 coupon-card'>
			<!-- Cambar src por imagen del cupón. -->
			<img class='image-card-top bg-body coupon-img' src='./default-coupon.png' alt='Imagen del cupón.'>
			<div class='card-body'>
				<div class='mb-3 d-flex flex-column'>
					<h5 class='card-title name'>{{ coupon.name }}</h5>
					<div class='border border-dashed border-success border-2 rounded p-1 mb-1 coupon-code'>
						<span class='code'>{{ coupon.code }}</span>
					</div>
					<span>
						<b>Hotel: </b>
						<span class='hotel_name'>
							{{ coupon.hotel_name }}
						</span>
					</span>
					<span><b>Usos restantes:</b> {{ coupon.limit_uses - coupon.uses_count }}</span>
				</div>
				<div class='d-flex'>
					<div class='flex-fill text-center'>
						<BtnOption
							type="button"
							color="primary"
							text="Editar"
							:action="{ id: 'coupons', method: 'edit', params: { id: coupon.id }}"
						/>
					</div>
					<div class='flex-fill text-center'>
						<BtnOption
							type="button"
							color="outline-danger"
							text="Eliminar"
							:action="{ id: 'coupons', method: 'destroy', params: { id: coupon.id }}"
						/>
					</div>
				</div>
			</div>
		</div>
	</a>
</template>

<script setup>
import BtnOption from '../BtnOption.vue'

defineProps({
  	coupon: {
    	require: true,
    	type: Object
  	}
})

const checkButtonPressed = e => {
	/*
	 * Debería depender de una propiedad más general y común, no todos los BtnOption cuentan
	 * con el atributo role.
	 */
	if (e.target.getAttribute('role') === 'button') e.preventDefault();
}
</script>

<style scoped>
.coupon-card {
	width: 100%;
	max-width: 16rem;
	cursor: pointer;
	user-select: none;

	transition: box-shadow .2s ease 0s;
}

.coupon-card:hover {
	box-shadow: 0 .125rem .25rem rgba(0 0 0 / .175);
}

.coupon-code {
	white-space: nowrap;
	width: min-content;
}

.coupon-img {
	width: 16rem;
	height: 16rem;
	object-fit: cover;
}
</style>
