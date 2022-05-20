<template>
	<div class="bg-white py-10">
		<div class="container">
			<section-header>
				<template #title>
					Featured Products
				</template>
				<template #subtitle>
					Completely network impactful users whereas next-generation
					applications.
				</template>
			</section-header>
			<div class="grid xs:grid-cols-2 lg:grid-cols-4 gap-7 mt-10">
				<product-card v-for="(product, index) in products" :key="index" :product="product"></product-card>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
	computed: {
		...mapGetters({
			products: "global/getFeatureProducts",
		}),
	},
};
</script>

<style lang="scss" scoped>
</style>