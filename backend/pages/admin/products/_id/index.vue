<template>
	<loader :loading="$fetchState.pending">
		<detail-view title="Product Details" :breadcrumb="breadcrumb" v-if="product">
			<!-- ID -->
			<detail-section class="border-b" label="ID" :value="product.id"></detail-section>

			<!-- Category -->
			<detail-section class="border-b" label="Category">
				{{product.category.name}}
			</detail-section>

			<!-- Name -->
			<detail-section class="border-b" label="Name" :value="product.name"></detail-section>

			<!-- SKU -->
			<detail-section class="border-b" label="SKU" :value="product.sku"></detail-section>

			<!-- Description -->
			<detail-section class="border-b" label="Description" :value="product.description"></detail-section>

			<!-- Price -->
			<detail-section class="border-b" label="Price" :value="product.priceFormatted"></detail-section>

			<!-- Quantity -->
			<detail-section class="border-b" label="Quantity">
				{{product.quantity}} {{product.unit.code}}
			</detail-section>

			<!-- Image -->
			<detail-section label="Image">
				<image-preview :url="product.imageUrl"></image-preview>
			</detail-section>

		</detail-view>
	</loader>
</template>

<script>
export default {
	name: "admin-product-details",
	layout: "admin",
	data() {
		return {
			product: null,
			breadcrumb: [
				{ label: "Home", route: "/admin/dashboard" },
				{ label: "Products", route: "/admin/products" },
				{ label: this.$route.params.id, route: null },
			],
		};
	},
	async fetch() {
		const response = await this.$axios.$get(
			`/admin/products/${this.$route.params.id}`
		);
		this.product = response.data;
	},
};
</script>
