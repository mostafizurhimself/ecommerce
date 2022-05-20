<template>
	<div class="flex items-center justify-center min-h-screen bg-gray-100">
		<div class="w-full sm:max-w-md px-8 py-6 mt-4 text-left bg-white shadow-lg">
			<div class="flex justify-center">
				<Logo class="h-16 mb-4" />
			</div>
			<h3 class="text-2xl font-bold text-center">Login to your account</h3>
			<form @submit.prevent="login">
				<div class="mt-4">
					<div>
						<form-label for="email" value="Email" />
						<form-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" autofocus />
						<form-error :message="validationErrors.email" class="mt-2" />
					</div>

					<div class="mt-4">
						<form-label for="password" value="Password" />
						<form-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" autocomplete="current-password" />
						<form-error :message="validationErrors.password" class="mt-2" />
					</div>

					<div class="mt-4">
						<form-button :disabled="isRequestProcessing" :class="{'opacity-50' : isRequestProcessing}" class="mt-5 w-full py-3">
							Log in
						</form-button>
					</div>

					<div class="text-center mt-5">
						<span class="text-sm">Forgot you password?</span>
						<nuxt-link to="#" class="text-primary-500 hover:underline text-sm">Click Here</nuxt-link>
					</div>

				</div>
			</form>
		</div>
	</div>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "admin-login",
	layout: "auth",
	middleware: "guest",
	mixins: [form],
	head() {
		return {
			title: "Login",
		};
	},
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
				const res = await this.$auth.loginWith("local", {
					data: this.form,
				});
				this.$router.push("/admin/dashboard");
				this.$toast.success("Logged In successfully.");
			} catch (err) {
				if (err.response.status === 401) {
					// Send toast message
					this.$toast.error(err.response.data.message);
				}
				console.error(err);
			}
		},
	},
};
</script>

<style lang="scss" scoped>
</style>