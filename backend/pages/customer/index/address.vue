<template>
	<div>
		<p class="flex bg-green-100 rounded-full px-4 py-3 text-sm text-green-700">
			<info-icon class="mr-2"></info-icon>
			The following addresses will be used on the checkout page by default.
		</p>

		<form class="mt-3" @submit.prevent="saveAddress">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div class="">
					<h5 class="text-xl font-semibold inline ">
						Billing Address
					</h5>

					<div class="mt-4">
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
						<form-checkbox tiny class="mt-3" v-model="shippingIsSame" @change="setShipping">
							<template #label>
								<span class="text-sm ml-6">
									<span class="font-semibold">Shipping Address</span> is same as <span class="font-semibold">Billing Address</span>
								</span>
							</template>
						</form-checkbox>
					</div>
				</div>
				<div class="">
					<h5 class="text-xl font-semibold inline">Shipping Address</h5>

					<div class="mt-4">
						<div>
							<form-input :disabled="shippingIsSame" class="w-full" placeholder="Street" v-model="formData.shippingAddress.street"></form-input>
							<form-error :message="validationErrors['shippingAddress.street']" class="mt-2" />
						</div>
						<div class="mt-4">
							<form-input :disabled="shippingIsSame" class="w-full" placeholder="City" v-model="formData.shippingAddress.city"></form-input>
							<form-error :message="validationErrors['shippingAddress.city']" class="mt-2" />
						</div>
						<div class="mt-4">
							<form-input :disabled="shippingIsSame" class="w-full" placeholder="State" v-model="formData.shippingAddress.state"></form-input>
							<form-error :message="validationErrors['shippingAddress.state']" class="mt-2" />
						</div>
						<div class="mt-4">
							<form-input :disabled="shippingIsSame" class="w-full" placeholder="Zipcode" v-model="formData.shippingAddress.zipcode"></form-input>
							<form-error :message="validationErrors['shippingAddress.zipcode']" class="mt-2" />
						</div>
						<div class="mt-4">
							<form-select :disabled="shippingIsSame" class="w-full" placeholder="Country" v-model="formData.shippingAddress.country" :options="countries"></form-select>
							<form-error :message="validationErrors['shippingAddress.country']" class="mt-2" />
						</div>
					</div>
				</div>
			</div>
			<form-button :class="{ 'opacity-25': isRequestProcessing }" :disabled="isRequestProcessing" class="bg-primary-500 text-white px-10 mt-4">Save</form-button>
		</form>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
import form from "~/plugins/mixins/form";

export default {
	name: "ProfileAddress",
	mixins: [form],
	data() {
		return {
			formData: {
				billingAddress: {
					street: this.$auth.user?.billingAddress?.street,
					city: this.$auth.user?.billingAddress?.city,
					state: this.$auth.user?.billingAddress?.state,
					zipcode: this.$auth.user?.billingAddress?.zipcode,
					country: this.$auth.user?.billingAddress?.country,
				},
				shippingAddress: {
					street: this.$auth.user?.shippingAddress?.street,
					city: this.$auth.user?.shippingAddress?.city,
					state: this.$auth.user?.shippingAddress?.state,
					zipcode: this.$auth.user?.shippingAddress?.zipcode,
					country: this.$auth.user?.shippingAddress?.country,
				},
			},
			shippingIsSame: false,
		};
	},
	computed: {
		...mapGetters({
			countries: "global/getCountries",
		}),
	},
	methods: {
		async saveAddress() {
			try {
				const resAddress = await this.$axios.$post(
					"/customer/address",
					this.formData
				);
				this.$auth.setUser(resAddress.data);
				this.$toast.success("Address updated successfully");
			} catch (error) {
				console.log(error);
			}
		},

		setShipping() {
			if (this.shippingIsSame) {
				this.setValues(
					this.formData.shippingAddress,
					this.formData.billingAddress
				);
			}
		},
	},

	created() {
		this.setValues(
			this.formData.billingAddress,
			this.$auth.user.billingAddress
		);
		this.setValues(
			this.formData.shippingAddress,
			this.$auth.user.shippingAddress
		);
	},
};
</script>
