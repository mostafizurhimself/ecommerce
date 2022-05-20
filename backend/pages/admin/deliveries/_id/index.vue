<template>
	<loader :loading="$fetchState.pending">
		<detail-view title="Delivery Details" :breadcrumb="breadcrumb" v-if="delivery">
			<!-- ID -->
			<detail-section class="border-b" label="ID" :value="delivery.id"></detail-section>

			<!-- Customer Name -->
			<detail-section class="border-b" label="Name" :value="delivery.customer.name"></detail-section>

			<!-- Customer Phone -->
			<detail-section class="border-b" label="Email" :value="delivery.customer.phone"></detail-section>

			<!-- Sub Total -->
			<detail-section class="border-b" label="Sub Total" :value="delivery.subTotalFormatted"></detail-section>

			<!-- Total Discount -->
			<detail-section class="border-b" label="Total Discount" :value="delivery.totalDiscountFormatted"></detail-section>

			<!-- Grand Total -->
			<detail-section class="border-b" label="Grand Total" :value="delivery.grandTotalFormatted"></detail-section>

			<!-- Payment Method -->
			<detail-section class="border-b" label="Payment Method">
				{{delivery.paymentMethod.toUpperCase()}}
			</detail-section>

			<!-- Billing Address -->
			<detail-section class="border-b" label="Billing Address">
				<p class="text-90" v-if="delivery.billingAddress">{{ delivery.billingAddress.street }}, {{ delivery.billingAddress.city }}, {{ delivery.billingAddress.country }} - {{ delivery.billingAddress.zipcode }}</p>
				<p v-else>-</p>
			</detail-section>

			<!-- Shipping Address -->
			<detail-section class="border-b" label="Shipping Address">
				<p class="text-90" v-if="delivery.shippingAddress">{{ delivery.shippingAddress.street }}, {{ delivery.shippingAddress.city }}, {{ delivery.shippingAddress.country }} - {{ delivery.shippingAddress.zipcode }}</p>
				<p v-else>-</p>
			</detail-section>

			<template #secondary-view>
				<h2 class="text-lg font-bold">Delivery Items</h2>
				<div class="rounded-primary overflow-hidden shadow-sm border mt-4">
					<div class="overflow-x-auto overflow-y-hidden">
						<table>
							<!-- header -->
							<thead>
								<tr>
									<th>ID</th>
									<th>Product Name</th>
									<th>Rate</th>
									<th>Unit</th>
									<th>Amount</th>
								</tr>
							</thead>
							<!-- body -->
							<tbody>
								<tr v-for="(item, index) in delivery.deliveryItems" :key="index">
									<td>{{index + 1}}</td>
									<td>{{item.product.name}}</td>
									<td>{{item.rateFormatted}}</td>
									<td>
										{{item.quantity}} {{item.unit.code}}
									</td>
									<td>{{item.amountFormatted}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</template>

		</detail-view>
	</loader>
</template>

<script>
export default {
	name: "admin-delivery-details",
	layout: "admin",
	data() {
		return {
			delivery: null,
			breadcrumb: [
				{ label: "Home", route: "/admin/dashboard" },
				{ label: "Deliveries", route: "/admin/deliveries" },
				{ label: this.$route.params.id, route: null },
			],
		};
	},
	methods: {
		async getDeliveryDetails() {
			const response = await this.$axios.$get(
				`/admin/deliveries/${this.$route.params.id}`
			);
			this.delivery = response.data;
		},

		handleSuccess() {
			this.getDeliveryDetails();
		},
	},
	async fetch() {
		await this.getDeliveryDetails();
	},
};
</script>
