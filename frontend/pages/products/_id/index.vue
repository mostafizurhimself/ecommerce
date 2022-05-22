<template>
	<loader :loading="$fetchState.pending">
		<!-- product -->
		<div class="container lg:flex my-5 md:my-10" v-if="product">
			<!-- left side -->
			<div class="lg:w-9/12 mr-4">
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div class="bg-gray-300 border rounded-primary overflow-hidden">
						<img class="object-cover h-full lg:object-scale-down" :src="product.imageUrl" :alt="product.name">
					</div>
					<!-- product details -->
					<div class="flex flex-col flex-grow-1 mt-6">
						<!-- category -->
						<div class="text-gray-700 font-semibold text-xs ml-1 mt-1">
							{{product.category.name}}
						</div>

						<h3 class="font-bold text-xl mt-2">{{product.name}}</h3>

						<!-- price -->
						<div class="mt-2 font-bold text-2xl">
							<span class="text-primary-500">{{product.priceFormatted}}</span>
						</div>

						<!-- quantity and add to cart button  -->
						<div class="py-4 border-b">
							<div class="w-32">
								<form-input-group type="number" :value="1" :label="product.unit.code"></form-input-group>
							</div>
						</div>

						<!-- wishlist -->
						<div class="flex items-center text-sm border-b py-4">
							<wishlist-button></wishlist-button>
							<span class="ml-1">Add to Wishlist</span>
						</div>

						<!-- share -->
						<div class="flex border-b py-4">
							<h5 class="text-sm">Share:</h5>
							<div class="flex items-start justify-start">
								<FacebookIcon class="h-4 w-4 ml-2" />
							</div>
						</div>

						<form-button type="button" @click="addToCart" class="mt-auto w-full">Add To Cart</form-button>
					</div>
				</div>

				<!-- description and reviews -->
				<div class="mt-12 lg:pr-6">
					<!-- nav -->
					<div class="flex border-b-2 border-gray-200">
						<h5 class="mr-7 pb-4 font-semibold cursor-pointer" :class="{'active' : activeComponent == 'product-description'}" @click="activeComponent = 'product-description'">Description</h5>
						<h5 class="mr-7 pb-4 font-semibold cursor-pointer" :class="{'active' : activeComponent == 'product-reviews'}" @click="activeComponent = 'product-reviews'">Reviews</h5>
					</div>

					<!-- body -->
					<div class="my-8">
						<div v-if="activeComponent == 'product-description'">
							<product-description :description="product.description"></product-description>
						</div>
						<div v-else>
							<product-reviews></product-reviews>
						</div>
					</div>
				</div>
			</div>

			<!-- Right side -->
			<div class="lg:w-3/12">

				<!-- Related products -->
				<div class="bg-white rounded-primary overflow-hidden border border-gray-200 mt-6 lg:mt-0 px-5">
					<h4 class="font-semibold my-5">Related products</h4>

					<div>
						<div class="flex border-t border-gray-200 py-5" v-for="(relatedProduct, i) in relatedProducts" :key="i">
							<!-- image -->
							<div class="h-20 w-20 flex-none">
								<img :src="relatedProduct.imageUrl" style="object-fit: contain" alt="product">
							</div>
							<!-- details -->
							<div class="ml-3">
								<!-- category -->
								<div class="text-gray-700 font-semibold text-xs ml-1 mt-1">
									{{relatedProduct.category.name}}
								</div>

								<!-- name -->
								<h6>
									<nuxt-link :to="`/products/${product.id}`" class="text-md font-semibold mt-2 inline-block">{{relatedProduct.name}}</nuxt-link>
								</h6>
								<!-- price -->
								<div class="font-bold text-sm mt-1">
									<span class="text-primary-500">{{relatedProduct.priceFormatted}}</span>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</loader>
</template>

<script>
export default {
	name: "single-product",
	head() {
		return {
			title: this.product && this.product.name,
		};
	},
	data() {
		return {
			product: null,
			relatedProducts: null,
			activeComponent: "product-description",
		};
	},
	computed: {
		shareLink() {
			return `${process.env.APP_URL}shop/${this.$route.params.id}`;
		},
	},
	methods: {
		addToCart() {
			this.$store.dispatch("cart/addToCart", this.product);
		},
	},
	async fetch() {
		const response = await this.$axios.$get(
			`/products/${this.$route.params.id}`
		);
		this.product = response.data;
		this.relatedProducts = response.relatedProducts;
	},
};
</script>

<style lang="scss" scoped>
.active {
	margin-bottom: -2px;
	@apply border-b-2 border-primary-500 text-primary-500;
}
</style>