<template>
	<div class="py-10">
		<div class="container flex flex-col items-center justify-center">
			<h3 class="font-bold text-3xl mb-4 text-primary-500">Log into your account</h3>
			<form class="w-full max-w-lg px-4 py-8 border bg-white rounded-primary shadow-lg mt-5" @submit.prevent="login">
				<!-- Email -->
				<div class="mt-4">
					<form-label class="mb-2" for="email" value="Email"></form-label>
					<form-input id="email" type="email" class="w-full" v-model="form.email"></form-input>
					<form-error :message="validationErrors.email" class="mt-2" />
				</div>

				<!-- Password -->
				<div class="mt-4">
					<form-label class="mb-2" for="password" value="Password"></form-label>
					<form-input id="password" type="password" class="w-full" v-model="form.password"></form-input>
					<form-error :message="validationErrors.password" class="mt-2" />
				</div>
				<form-button class="w-full py-3 mt-4">Sign In</form-button>
				<div class="my-4 text-center">
					<p class="text-sm">
						Doesn't have an account?
						<nuxt-link to="/register" class="text-sm text-primary-500 hover:underline">Create an account</nuxt-link>
					</p>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "customer-login",
	mixins: [form],
	middleware: "guest",
	data() {
		return {
			form: {
				email: null,
				password: null,
			},
		};
	},
	methods: {
		async login() {
			try {
				const res = await this.$auth.loginWith("customer", {
					data: this.form,
				});
				this.$router.push("/customer");
				this.$toast.success("Logged In successfully.");
			} catch (err) {
				if (err.response.status === 401) {
					this.$toast.error(err.response.data.message);
				}
				console.error(err);
			}
		},
	},
};
</script>
