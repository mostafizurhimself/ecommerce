<template>
	<div class="py-10">
		<div class="container flex flex-col items-center justify-center">
			<h3 class="font-bold text-3xl mb-4 text-primary-500">Change Password</h3>
			<form class="w-full bg-white max-w-lg px-4 py-8 rounded-primary border shadow-lg mt-3" @submit.prevent="changePassword">
				<!-- Old Password -->
				<div class="mt-4">
					<form-label class="mb-2" for="old-password" value="Old Password"></form-label>
					<form-input id="old-password" type="password" class="w-full" v-model="form.oldPassword"></form-input>
					<form-error :message="validationErrors.oldPassword" class="mt-2" />
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
					Change
				</form-button>
			</form>
		</div>
	</div>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "ChangePassword",
	middleware: ["auth"],
	mixins: [form],
	data() {
		return {
			form: {
				oldPassword: null,
				password: null,
				password_confirmation: null,
			},
		};
	},
	methods: {
		async changePassword() {
			try {
				await this.$axios.$post("/customer/change-password", this.form);
				this.$router.push("/customer");
				this.$toast.success(response.message);
			} catch (error) {
				console.log(error);
			}
		},
	},
};
</script>

<style lang="scss" scoped>
</style>