<template>
	<div class="flex items-center h-full px-4 lg:px-6">
		<dropdown width="72" class="hidden md:flex">
			<template #trigger>
				<div class="cursor-pointer">
					<CartIcon class="relative" />
					<div v-if="cartItems && cartItems.length" class="absolute -top-2.5 -right-2.5 bg-primary-500 h-5 w-5 rounded-full flex items-center justify-center">
						<span class="inline-block mb-0 text-xs text-white whitespace-nowrap">{{totalItems}}</span>
					</div>
				</div>
			</template>

			<template #content={close}>
				<div class="bg-white">
					<div v-if="cartItems && cartItems.length">
						<!-- header -->
						<div class="bg-primary-500 text-white py-2 px-3">
							<p class="text-center text-sm tracking-wider">{{totalItems}} Items Added</p>
						</div>

						<!-- body -->
						<div class="overflow-y-auto" style="height: 295px;">
							<!-- cart items -->
							<div class="p-5 border-b border-gray-100" v-for="(item, index) in cartItems" :key="index">
								<div class="flex items-center justify-between">
									<div class="flex">
										<div class="h-16 w-16 border rounded-lg overflow-hidden">
											<img :src="item.imageUrl" class="w-full h-full object-cover" :alt="item.name" />
										</div>
										<div class="ml-3 mt-2 text-sm">
											<h6 class="block font-semibold">{{item.name}}</h6>
											<span>Price: {{item.priceFormatted}}</span>
										</div>
									</div>
									<remove-icon-button @click="removeFromCart(item)"></remove-icon-button>
								</div>

								<!-- items -->
								<div class="flex items-center justify-between font-semibold text-sm mt-4">
									<div class="w-28">
										<form-input-group :label="item.unit.code" @input="changedQuantity($event, item)" :value="item.quantity"></form-input-group>
									</div>
									<span>Total: {{currencyFormat(item.quantity * item.price)}}</span>
								</div>
							</div>
						</div>

						<!-- footer -->
						<div class="py-3 px-4 bg-gray-50">
							<div class="text-right flex items-center justify-between font-semibold text-sm mt-1">
								<span>Cart Total</span>
								<span>{{currencyFormat(totalPrice)}}</span>
							</div>
							<form-button type="button" @click="close(); $router.push('/cart')" class="w-full mt-4">View Cart</form-button>
						</div>
					</div>

					<div v-else class="py-3 px-4 h-16 flex items-center justify-center">No Items Added!</div>
				</div>
			</template>
		</dropdown>

		<!-- cart on mobile nav -->
		<nuxt-link to="/cart" class="md:hidden">
			<div class="cursor-pointer relative">
				<CartIcon class="text-gray-800" />
				<div class="absolute -top-2.5 -right-2.5 bg-primary-500 h-5 w-5 rounded-full flex items-center justify-center" v-if="totalItems">
					<span class="inline-block mb-0 text-xs text-white whitespace-nowrap">{{totalItems}}</span>
				</div>
			</div>
		</nuxt-link>
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
</style>