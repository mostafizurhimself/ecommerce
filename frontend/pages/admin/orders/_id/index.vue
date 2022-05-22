<template>
	<loader :loading="$fetchState.pending">
		<detail-view title="Order Details" :breadcrumb="breadcrumb" v-if="order">
			<!-- ID -->
			<detail-section class="border-b" label="ID" :value="order.id"></detail-section>

			<!-- Customer Name -->
			<detail-section class="border-b" label="Name" :value="order.customer.name"></detail-section>

			<!-- Customer Phone -->
			<detail-section class="border-b" label="Email" :value="order.customer.phone"></detail-section>

			<!-- Sub Total -->
			<detail-section class="border-b" label="Sub Total" :value="order.subTotalFormatted"></detail-section>

			<!-- Total Discount -->
			<detail-section class="border-b" label="Total Discount" :value="order.totalDiscountFormatted"></detail-section>

			<!-- Grand Total -->
			<detail-section class="border-b" label="Grand Total" :value="order.grandTotalFormatted"></detail-section>

			<!-- Payment Method -->
			<detail-section class="border-b" label="Payment Method">
				{{order.paymentMethod.toUpperCase()}}
			</detail-section>

			<!-- Status -->
			<detail-section class="border-b" label="Status">
				<badge :value="order.status"></badge>
			</detail-section>

			<!-- Billing Address -->
			<detail-section class="border-b" label="Billing Address">
				<p class="text-90" v-if="order.billingAddress">{{ order.billingAddress.street }}, {{ order.billingAddress.city }}, {{ order.billingAddress.country }} - {{ order.billingAddress.zipcode }}</p>
				<p v-else>-</p>
			</detail-section>

			<!-- Shipping Address -->
			<detail-section class="border-b" label="Shipping Address">
				<p class="text-90" v-if="order.shippingAddress">{{ order.shippingAddress.street }}, {{ order.shippingAddress.city }}, {{ order.shippingAddress.country }} - {{ order.shippingAddress.zipcode }}</p>
				<p v-else>-</p>
			</detail-section>

			<!-- Action -->
			<detail-section class="border-b" label="Action">
				<div class="flex">
					<client-only>
						<update-order-status class="mr-4" :ids="[order.id]" @success="handleSuccess" type="single"></update-order-status>
						<mark-as-delivered v-if="order.status != 'delivered'" :ids="[order.id]" @success="handleSuccess" type="single"></mark-as-delivered>
					</client-only>
				</div>
			</detail-section>

			<template #secondary-view>
				<h2 class="text-lg font-bold">Order Items</h2>
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
								<tr v-for="(item, index) in order.orderItems" :key="index">
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

				<div v-if="order.orderLogs && order.orderLogs.length" class="mt-5">
					<h2 class="text-lg font-bold mb-5">Edit History</h2>
					<edit-history :logs="order.orderLogs"></edit-history>
				</div>
			</template>

		</detail-view>
	</loader>
</template>

<script>
export default {
	name: "admin-order-details",
	layout: "admin",
	data() {
		return {
			order: null,
			breadcrumb: [
				{ label: "Home", route: "/admin/dashboard" },
				{ label: "Orders", route: "/admin/orders" },
				{ label: this.$route.params.id, route: null },
			],
		};
	},
	methods: {
		async getOrderDetails() {
			const response = await this.$axios.$get(
				`/admin/orders/${this.$route.params.id}`
			);
			this.order = response.data;
		},

		handleSuccess() {
			this.getOrderDetails();
		},
	},
	async fetch() {
		await this.getOrderDetails();
	},
};
</script>
