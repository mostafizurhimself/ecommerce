<template>
	<div class="py-10">
		<div class="container">
			<div class="lg:flex">
				<div class="lg:w-9/12 lg:mr-5">
					<h5 class="font-semibold text-xl mb-3">Cart Items</h5>
					<!-- cart item -->
					<div class="rounded-primary overflow-hidden" v-if="cartItems.length">
						<div class="overflow-x-auto overflow-y-hidden w-full">
							<table>
								<thead>
									<tr>
										<th>Product</th>
										<th>Name</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Total</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(item, index) in cartItems" :key="index">
										<td>
											<div class="h-16 w-16">
												<img :src="item.imageUrl" class="w-full h-full object-cover" :alt="item.name">
											</div>
										</td>
										<td> {{item.name}} </td>
										<td>{{item.priceFormatted}}</td>
										<td>
											<form-input-group :label="item.unit.code" @input="changedQuantity($event, item)" :value="item.quantity"></form-input-group>
										</td>
										<td><span class="font-semibold"> {{currencyFormat(item.quantity * item.price)}} </span> </td>
										<td>
											<remove-icon-button @click="removeFromCart(item)"></remove-icon-button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- if no cart items -->
					<div v-else>
						<div class="flex flex-col items-center justify-center text-gray-300 h-44 bg-gray-50 rounded-lg">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
								<path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
								<path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
							</svg>
							<p class="mt-2 text-gray-400">Your cart is Empty!</p>
						</div>
					</div>
				</div>
				<div class="md:w-6/12 lg:w-3/12 mt-10 lg:mt-0">
					<h5 class="font-semibold text-xl mb-3">Cart Details</h5>

					<div class="bg-gray-200 p-4 rounded-primary">
						<p class="flex justify-between py-2 text-sm">
							<span class="font-medium">
								Sub Total:
							</span>
							<span class="font-bold">
								{{currencyFormat(totalPrice)}}
							</span>
						</p>
						<p class="flex justify-between py-2 text-sm border-b border-gray-300">
							<span class="font-medium">
								Discount:
							</span>
							<span class="font-bold">
								{{currencyFormat(totalDiscount)}}
							</span>
						</p>
						<p class="flex justify-between py-2 text-sm">
							<span class="font-medium">
								Cart Total:
							</span>
							<span class="font-bold">
								{{currencyFormat(grandTotal)}}
							</span>
						</p>
					</div>
					<button-link class="w-full mt-4 text-sm" to="/checkout">PROCEED TO CHECKOUT</button-link>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
export default {
	computed: {
		...mapGetters({
			cartItems: "cart/getCartItems",
			totalItems: "cart/getTotalItem",
			totalPrice: "cart/getTotalPrice",
			totalDiscount: "cart/getTotalDiscount",
			grandTotal: "cart/getGrandTotal",
		}),
	},

	methods: {
		...mapMutations({
			cartItemQuantity: "cart/CART_ITEM_QUANTITY",
		}),

		removeFromCart(item) {
			this.$store.dispatch("cart/removeFromCart", item);
		},

		changedQuantity(value, item) {
			this.cartItemQuantity({
				item,
				val: value,
			});
		},
	},
};
</script>


<style lang="scss" scoped>
.disabled {
	pointer-events: none;
	opacity: 0.6;
}
</style>