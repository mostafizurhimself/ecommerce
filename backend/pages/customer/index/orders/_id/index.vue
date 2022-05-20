<template>
	<loader :loading="$fetchState.pending">
		<div v-if="order">
			<div class="flex justify-between mb-6">
				<nuxt-link to="/customer/orders" class="inline-flex items-center mb-3 text-gray-900 text-sm hover:text-primary-500">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
						<path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
					</svg>
					<span class="ml-1">
						Back
					</span>
				</nuxt-link>

				<client-only>
					<cancel-order :order="order" @success="handleCancelRequestSuccess" v-if="order.status == 'pending'"></cancel-order>
				</client-only>
			</div>

			<!-- invoice details -->
			<div class="sm:flex justify-between items-start">
				<!-- invoice number -->
				<div>
					<div class="flex items-center">
						<h5 class="font-semibold text-lg">Invoice: {{order.invoiceNo}}</h5>
						<badge class="ml-3" :value="order.status"></badge>
					</div>
					<p class="font-normal text-sm">{{order.dateFormatted}}</p>
				</div>
				<!-- customer details -->
				<div v-if="order && order.customer" class="sm:text-right">
					<h5 class="font-semibold"> {{order.customer.name}}</h5>
					<p class="text-sm"> {{order.customer.email}}</p>
					<p class="text-sm"> {{order.customer.phone}}</p>
				</div>
			</div>
			<!-- Address Details -->
			<div class="sm:flex justify-between mt-5">
				<div>
					<h6 class="font-semibold">Billing Address</h6>
					<p class="text-sm">
						<span class="whitespace-nowrap">{{order.billingAddress.street}} </span>
						<br>
						<span class="whitespace-nowrap">{{order.billingAddress.state}},
							{{order.billingAddress.city}},
							{{order.billingAddress.country}}
						</span>
					</p>
				</div>

				<div class="text-right">
					<h6 class="font-semibold">Shipping Address</h6>
					<p class="text-sm">
						<span class="whitespace-nowrap">{{order.shippingAddress.street}} </span>
						<br>
						<span class="whitespace-nowrap">{{order.shippingAddress.state}},
							{{order.shippingAddress.city}},
							{{order.shippingAddress.country}}
						</span>
					</p>
				</div>
			</div>
			<!-- Order Details -->

			<!-- order items -->
			<p class="flex justify-between items-center font-semibold text-lg mt-10 mb-3 ">
				<span>Order Items</span>
				<button class="btn btn-success" :class="{ 'opacity-50': isRequestProcessing }" :disabled="isRequestProcessing" @click="update">Save Changes</button>
			</p>
			<div class="rounded-primary overflow-hidden shadow-sm border">
				<div class="overflow-x-auto overflow-y-hidden">
					<table>
						<!-- header -->
						<thead>
							<tr>
								<th>ID</th>
								<th>Product Name</th>
								<th class="text-right">Rate</th>
								<th>Unit</th>
								<th class="text-right">Amount</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<!-- body -->
						<tbody>
							<tr v-for="(item, index) in order.orderItems" :key="index">
								<td>{{index + 1}}</td>
								<td>{{item.product.name}}</td>
								<td class="text-right">{{item.rateFormatted}}</td>
								<td>
									<div class="w-24" v-if="order.status == 'pending'">
										<form-input-group :label="item.unit.code" v-model="item.quantity"></form-input-group>
									</div>
									<span v-else>
										{{item.quantity}} {{item.unit.code}}
									</span>
								</td>
								<td class="text-right font-medium">{{currencyFormat(item.quantity * item.rate)}}</td>
								<td class="text-right">
									<remove-icon-button @click="removeItem(index)" v-if="order.orderItems.length > 1"></remove-icon-button>
								</td>
							</tr>
							<tr>
								<td scope="row" colspan="4" class="py-3 px-4 text-right font-semibold">Sub Total</td>
								<td class="text-right font-medium">{{currencyFormat(subTotal)}}</td>
								<td></td>
							</tr>
							<tr>
								<td scope="row" colspan="4" class="py-3 px-4 text-right font-semibold">Total Discount</td>
								<td class="text-right font-medium">{{order.totalDiscountFormatted}}</td>
								<td></td>
							</tr>
							<tr>
								<td scope="row" colspan="4" class="py-3 px-4 text-right font-semibold">Grand Total</td>
								<td class="text-right font-medium">{{currencyFormat(grandTotal)}}</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="mt-6" v-if="order.orderLogs && order.orderLogs.length">
				<p class="text-xl font-semibold mb-4">Edit History</p>
				<edit-history :logs="order.orderLogs"></edit-history>
			</div>

		</div>
	</loader>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "customer-order-detail",
	data() {
		return {
			order: null,
		};
	},
	mixins: [form],
	computed: {
		subTotal() {
			let total = 0;
			this.order.orderItems.forEach((item) => {
				total += item.rate * item.quantity;
			});
			return total;
		},

		grandTotal() {
			return this.subTotal + this.order.totalDiscount;
		},
	},
	methods: {
		handleCancelRequestSuccess() {
			this.getOrderDetails();
		},

		removeItem(index) {
			this.order.orderItems.splice(index, 1);
		},

		async update() {
			try {
				const response = await this.$axios.$put(
					`/orders/${this.order.id}`,
					this.order
				);
				this.$toast.success("Order updated successfully");
			} catch (error) {
				console.error(error);
			}
		},

		async getOrderDetails() {
			const response = await this.$axios.$get(
				`/orders/${this.$route.params.id}`
			);
			this.order = response.data;
		},
	},

	async fetch() {
		await this.getOrderDetails();
	},
};
</script>

<style lang="scss" scoped>
</style>