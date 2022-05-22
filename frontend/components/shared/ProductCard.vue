<template>
	<!-- Shop Products -->
	<div class="bg-white border border-transparent hover:border-primary-500 rounded-primary overflow-hidden mx-auto relative product p-2">
		<!-- image -->
		<div class="bg-white flex justify-center item-center product-image relative rounded-primary">
			<img :src="product.imageUrl" class="h-full w-full" alt="product" style="object-fit: cover;">

			<!-- options on hover -->
			<div class="product-options absolute flex items-center justify-center">

				<!-- add to cart button -->
				<button @click="addToCart" class=" h-12 w-12 bg-white hover:bg-primary-500 rounded-full shadow-md flex justify-center items-center text-primary-500 hover:text-white cursor-pointer">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
					</svg>
				</button>

				<!-- view button -->
				<nuxt-link :to="`/products/${product.id}`" class="ml-4 h-12 w-12 bg-white hover:bg-primary-500 rounded-full shadow-md flex justify-center items-center text-primary-500 hover:text-white cursor-pointer">
					<svg xmlns="http://www.w3.org/2000/svg" class="h5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
					</svg>
				</nuxt-link>

			</div>

			<!-- badge -->
			<div class="absolute top-3 right-3">
				<!-- <span class="bg-primary-500 text-white text-xs px-3 py-1 rounded-full uppercase tracking-wider">NEW</span> -->
				<span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full uppercase tracking-wider" v-if="product.quantity <= 0">Out of stock</span>
			</div>
		</div>

		<!-- details -->
		<div class="flex items-center justify-between p-4">
			<h6>
				<nuxt-link :to="`/products/${product.id}`" class="font-medium hover:text-primary-500">
					<truncate :value="product.name" :length="40"></truncate>
				</nuxt-link>
			</h6>
			<p class="text-grey-300 whitespace-nowrap text-sm">{{product.priceFormatted}}</p>
		</div>

	</div>
	<!-- End Shop Products -->
</template>

<script>
export default {
	name: "product-card",
	props: {
		product: {
			type: Object,
		},
	},
	methods: {
		addToCart() {
			this.$store.dispatch("cart/addToCart", this.product);
		},
	},
};
</script>

<style lang="scss" scoped>
.product {
	box-shadow: #7c3aed15 1px 2px 6px 2px;
}
.product:hover {
	box-shadow: #7c3aed1b 1px 4px 12px;
}

.product-options {
	opacity: 0;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -20%);
	transition: all 0.3s ease-in;
}

.product:hover {
	.product-image {
		@apply bg-gray-300;
		transition: all 0.2s ease-in;

		.product-options {
			color: red;
			transform: translate(-50%, -50%);
			opacity: 1;
		}
	}
}
</style>