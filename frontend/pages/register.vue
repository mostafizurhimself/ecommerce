<template>
	<div class="py-10">
		<div class="container flex flex-col items-center justify-center">
			<h3 class="font-bold text-3xl mb-4 text-primary-500">Create an Acoount</h3>
			<form @submit.prevent="register" class="w-full bg-white border max-w-lg px-4 py-8 rounded-primary shadow-lg mt-5">

				<!-- First Name -->
				<div class="">
					<form-label class="mb-2" for="firstName" value="First Name"></form-label>
					<form-input id="firstName" type="text" class="w-full" v-model="form.firstName"></form-input>
					<form-error :message="validationErrors.firstName" class="mt-2" />
				</div>

				<!-- Last Name -->
				<div class="">
					<form-label class="mb-2" for="lastName" value="Last Name"></form-label>
					<form-input id="lastName" type="text" class="w-full" v-model="form.lastName"></form-input>
					<form-error :message="validationErrors.lastName" class="mt-2" />
				</div>

				<!-- Email -->
				<div class="mt-4">
					<form-label class="mb-2" for="email" value="Email"></form-label>
					<form-input id="email" type="email" class="w-full" v-model="form.email"></form-input>
					<form-error :message="validationErrors.email" class="mt-2" />
				</div>

				<!-- Phone -->
				<div class="mt-4">
					<form-label class="mb-2" for="phone" value="Phone"></form-label>
					<form-input id="phone" type="tel" class="w-full" v-model="form.phone"></form-input>
					<form-error :message="validationErrors.phone" class="mt-2" />
				</div>

				<!-- Password -->
				<div class="mt-4">
					<form-label class="mb-2" for="password" value="Password"></form-label>
					<form-input id="password" type="password" class="w-full" v-model="form.password"></form-input>
					<form-error :message="validationErrors.password" class="mt-2" />
				</div>

				<!-- Confirm Password -->
				<div class="mt-4">
					<form-label class="mb-2" for="password_confirmation" value="Confirm Password"></form-label>
					<form-input id="password_confirmation" type="password" class="w-full" v-model="form.password_confirmation"></form-input>
				</div>

				<form-button class="bg-primary-500 text-white py-3 mt-6 w-full">
					Sign Up
				</form-button>

				<div class="my-4 text-center">
					<p class="text-sm">
						Already have an account?
						<nuxt-link to="/login" class="text-primary-500 hover:underline">Sign In</nuxt-link>
					</p>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "customer-register",
	mixins: [form],
	data() {
		return {
			form: {
				firstName: "",
				lastName: "",
				email: "",
				phone: "",
				password: "",
				password_confirmation: "",
			},
		};
	},
	methods: {
		async register() {
			try {
				await this.$axios.$post("/customer/register", this.form);
				await this.$auth.loginWith("customer", {
					data: {
						email: this.form.email,
						password: this.form.password,
					},
				});
				this.$router.push("/customer");
			} catch (error) {
				console.log(error);
			}
		},
	},
};
</script>
