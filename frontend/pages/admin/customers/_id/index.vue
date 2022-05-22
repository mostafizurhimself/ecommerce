<template>
	<loader :loading="$fetchState.pending">
		<detail-view title="Customer Details" :breadcrumb="breadcrumb" v-if="customer">
			<!-- ID -->
			<detail-section class="border-b" label="ID" :value="customer.id"></detail-section>

			<!-- Name -->
			<detail-section class="border-b" label="Name" :value="customer.name"></detail-section>

			<!-- Email -->
			<detail-section class="border-b" label="Email" :value="customer.email"></detail-section>

			<!-- Phone -->
			<detail-section class="border-b" label="Phone" :value="customer.phone"></detail-section>

			<!-- Image -->
			<detail-section label="Image">
				<image-preview :url="customer.profilePhotoUrl"></image-preview>
			</detail-section>

		</detail-view>
	</loader>
</template>

<script>
export default {
	name: "admin-customer-details",
	layout: "admin",
	data() {
		return {
			customer: null,
			breadcrumb: [
				{ label: "Home", route: "/admin/dashboard" },
				{ label: "Customers", route: "/admin/customers" },
				{ label: this.$route.params.id, route: null },
			],
		};
	},
	async fetch() {
		const response = await this.$axios.$get(
			`/admin/customers/${this.$route.params.id}`
		);
		this.customer = response.data;
	},
};
</script>
