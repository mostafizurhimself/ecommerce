<template>
	<div class="py-10">
		<div class="container">
			<div class="mx-auto">
				<h5 class="font-semibold text-xl mb-3">Personal Information</h5>
				<form @submit.prevent="login" autocomplete="off">
					<!-- number found notice -->
					<div class="flex items-center mb-4 text-green-500" v-if="customerExist">
						<info-icon></info-icon>
						<h5 class="text-md ml-1">This email already has an account! Please Sign In.</h5>
					</div>

					<!-- input fields -->
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div class="">
							<div>
								<form-input tabindex="1" class="w-full" :disabled="$auth.loggedIn" type="email" placeholder="Email" v-model="formData.email" @blur="searchCustomer"></form-input>
								<form-error :message="validationErrors.email" class="mt-2" />
							</div>
							<div class="mt-4">
								<form-input tabindex="3" class="w-full" :disabled="$auth.loggedIn" v-if="!customerExist" type="text" placeholder="First Name" v-model="formData.firstName"></form-input>
								<form-error :message="validationErrors.firstName" class="mt-2" />
							</div>
							<div class="mt-4">
								<form-input tabindex="5" class="w-full" :disabled="$auth.loggedIn" v-if="!$auth.loggedIn" placeholder="Password" type="password" v-model="formData.password"></form-input>
								<form-error :message="validationErrors.password" class="mt-2" />
							</div>
						</div>
						<div class="">
							<div>
								<form-input tabindex="2" class="w-full" :disabled="$auth.loggedIn" v-if="!customerExist" placeholder="Phone" type="tel" v-model="formData.phone"></form-input>
								<form-error :message="validationErrors.phone" class="mt-2" />
							</div>
							<div class="mt-4">
								<form-input tabindex="4" class="w-full" :disabled="$auth.loggedIn" v-if="!customerExist" type="text" placeholder="Last Name" v-model="formData.lastName"></form-input>
								<form-error :message="validationErrors.lastName" class="mt-2" />
							</div>
							<div class="mt-4">
								<form-input tabindex="6" class="w-full" :disabled="$auth.loggedIn" v-if="!$auth.loggedIn && !customerExist" placeholder="Confirm Password" type="password" v-model="formData.password_confirmation"></form-input>
							</div>
						</div>
					</div>

					<!-- button and links -->
					<form-button class="w-36 mt-4" v-if="customerExist">Sign In</form-button>
				</form>

				<!-- address -->
				<div class="mt-10">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<h5 class="font-semibold text-xl mb-3">Billing Address</h5>
							<div class="mt-3 ">
								<div>
									<form-input class="w-full" placeholder="Street" v-model="formData.billingAddress.street"></form-input>
									<form-error :message="validationErrors['billingAddress.street']" class="mt-2" />
								</div>
								<div class="mt-4">
									<form-input class="w-full" placeholder="City" v-model="formData.billingAddress.city"></form-input>
									<form-error :message="validationErrors['billingAddress.city']" class="mt-2" />
								</div>
								<div class="mt-4">
									<form-input class="w-full" placeholder="State" v-model="formData.billingAddress.state"></form-input>
									<form-error :message="validationErrors['billingAddress.state']" class="mt-2" />
								</div>
								<div class="mt-4">
									<form-input class="w-full" placeholder="Zipcode" v-model="formData.billingAddress.zipcode"></form-input>
									<form-error :message="validationErrors['billingAddress.zipcode']" class="mt-2" />
								</div>
								<div class="mt-4">
									<form-select class="w-full" placeholder="Country" v-model="formData.billingAddress.country" :options="countries"></form-select>
									<form-error :message="validationErrors['billingAddress.country']" class="mt-2" />
								</div>
							</div>
							<form-checkbox tiny class="mt-4" v-model="shippingIsSame" @change="setShipping">
								<template #label>
									<span class="pl-6 text-sm">
										<span class="font-semibold">Shipping address</span> is same as <span class="font-semibold">Billing Address</span>
									</span>
								</template>
							</form-checkbox>
						</div>
						<div>
							<h5 class="font-semibold text-xl mb-3">Shipping Address</h5>
							<div class="mt-3 ">
								<div>
									<form-input class="w-full" placeholder="Street" v-model="formData.shippingAddress.street"></form-input>
									<form-error :message="validationErrors['shippingAddress.street']" class="mt-2" />
								</div>
								<div class="mt-4">
									<form-input class="w-full" placeholder="City" v-model="formData.shippingAddress.city"></form-input>
									<form-error :message="validationErrors['shippingAddress.city']" class="mt-2" />
								</div>
								<div class="mt-4">
									<form-input class="w-full" placeholder="State" v-model="formData.shippingAddress.state"></form-input>
									<form-error :message="validationErrors['shippingAddress.state']" class="mt-2" />
								</div>
								<div class="mt-4">
									<form-input class="w-full" placeholder="Zipcode" v-model="formData.shippingAddress.zipcode"></form-input>
									<form-error :message="validationErrors['shippingAddress.zipcode']" class="mt-2" />
								</div>
								<div class="mt-4">
									<form-select class="w-full" placeholder="Country" v-model="formData.shippingAddress.country" :options="countries"></form-select>
									<form-error :message="validationErrors['shippingAddress.country']" class="mt-2" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="mt-10">
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<h5 class="font-semibold text-lg mb-3">Cart Totals</h5>
						<div class="bg-gray-200 px-4 py-6 rounded-primary">
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
					</div>

					<!-- payment methods -->
					<div>
						<h5 class="font-semibold text-lg mb-3">Payment Method</h5>
						<!-- paymemt options -->
						<div class="bg-white border rounded-primary px-5 py-6">
							<div class="flex items-center">
								<input class="mr-4" type="radio" name="method" id="cod" value="cod" v-model="paymentMethod">
								<label class="font-semibold text-sm" for="cod"> Cash On Delivery</label>
							</div>
							<div class="flex items-center mt-4">
								<input disabled class="mr-4" type="radio" name="method" id="bkash" value="bkash" v-model="paymentMethod">
								<label class="font-semibold text-sm text-gray-400" for="bkash">Bkash Payment</label>
							</div>
							<div class="flex items-center mt-4">
								<input disabled class="mr-4" type="radio" name="method" id="nagad" value="nagad" v-model="paymentMethod">
								<label class="font-semibold text-sm text-gray-400" for="nagad"> Nagad Payment</label>
							</div>
						</div>
						<!-- Agree-->
						<form-checkbox tiny class="mt-3" v-model="termsAgreed">
							<template #label>
								<span class="text-sm ml-6">
									I am agree to your <span class="font-semibold text-primary-500">Terms & Conditions</span>
								</span>
							</template>
						</form-checkbox>
						<!-- payment buttons -->
						<div class="mt-4">
							<form-button type="button" @click="placeOrder" class="py-3 w-full uppercase tracking-widest" :class="{ 'opacity-25': !canPlaceOrder || isRequestProcessing }" :disabled="!canPlaceOrder || isRequestProcessing">Place Order</form-button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import form from "~/plugins/mixins/form";
import { mapGetters } from "vuex";
export default {
	name: "CheckoutPage",

	data() {
		return {
			formData: {
				firstName: "",
				lastName: "",
				email: "",
				phone: "",
				password: "",
				password_confirmation: "",
				billingAddress: {
					street: "",
					city: "",
					state: "",
					zipcode: "",
					country: "",
				},
				shippingAddress: {
					street: "",
					city: "",
					state: "",
					zipcode: "",
					country: "",
				},
			},
			customerExist: false,
			paymentMethod: null,
			termsAgreed: false,
			shippingIsSame: false,
		};
	},

	mixins: [form],

	computed: {
		...mapGetters({
			cartItems: "cart/getCartItems",
			getTotalItem: "cart/getTotalItem",
			totalPrice: "cart/getTotalPrice",
			totalDiscount: "cart/getTotalDiscount",
			grandTotal: "cart/getGrandTotal",
			countries: "global/getCountries",
		}),

		/**
		 * Check user can place order or not
		 */
		canPlaceOrder() {
			return this.termsAgreed && this.paymentMethod;
		},

		/**
		 * Serialize the order items from cart
		 */
		orderItems() {
			return this.cartItems.map((item) => {
				return {
					productId: item.id,
					rate: item.price,
					quantity: item.quantity,
					amount: item.quantity * item.price,
					unitId: item.unit.id,
				};
			});
		},
	},

	methods: {
		/**
		 * Set shipping address
		 */
		setShipping() {
			this.setValues(
				this.formData.shippingAddress,
				this.formData.billingAddress
			);
		},

		/**
		 * Check customer is exists or not
		 */
		async searchCustomer() {
			try {
				if (!this.$auth.loggedIn) {
					const resCustomer = await this.$axios.$post(
						"/customers/check",
						{
							email: this.formData.email,
						}
					);
					this.customerExist = true;
				}
			} catch (error) {
				this.customerExist = false;
			}
		},

		/**
		 * Login in the customer if exists
		 */
		async login() {
			try {
				let response = await this.$auth.loginWith("customer", {
					data: {
						email: this.formData.email,
						password: this.formData.password,
					},
				});
				this.customerExist = false;
				this.reset("formData");
				this.setValues(this.formData, this.$auth.user);
				this.$router.push("/checkout");
				this.$toast.success("Login successfull");
			} catch (error) {
				console.log(err);
			}
		},

		/**
		 * Place the order
		 */
		async placeOrder() {
			try {
				const response = await this.$axios.$post("/orders", {
					customerId: this.$auth.loggedIn ? this.$auth.user.id : null,
					paymentMethod: this.paymentMethod,
					subTotal: this.totalPrice,
					totalDiscount: 0,
					orderItems: this.orderItems,
					...this.formData,
				});
				this.$toast.success("Thank you for the order!");
				this.$store.dispatch("cart/resetCart");
				this.$router.push("/customer/orders");
			} catch (error) {
				console.log(error);
			}
		},
	},
	created() {
		if (this.$auth.loggedIn) {
			// Set user data
			this.setValues(this.formData, this.$auth.user, [
				"billingAddress",
				"shippingAddress",
			]);
			// Set billing address
			if (this.$auth.user.billingAddress) {
				this.setValues(
					this.formData.billingAddress,
					this.$auth.user.billingAddress
				);
			}
			// Set shipping address
			if (this.$auth.user.shippingAddress) {
				this.setValues(
					this.formData.shippingAddress,
					this.$auth.user.shippingAddress
				);
			}
		}
	},
};
</script>