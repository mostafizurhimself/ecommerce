<template>
	<form-view @submitted="save" title="Change Password" :breadcrumb="breadcrumb">
		<template #form>
			<!-- Old Password -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="oldPassword" value="Old Password" required />
				<div class="w-full mt-1">
					<form-input v-model="form.oldPassword" id="oldPassword" type="password" class="w-full" autocomplete="oldPassword" />
					<form-error :message="validationErrors.oldPassword" class="mt-2" />
				</div>
			</form-group>

			<!--  Password -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="password" value=" Password" />
				<div class="w-full">
					<form-input v-model="form.password" id="password" type="password" class="w-full" autocomplete="password" />
					<form-error :message="validationErrors.password" class="mt-2" />
				</div>
			</form-group>

			<!--  Password Confirmation -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="password_confirmation" value=" Password Confirmation" />
				<div class="w-full">
					<form-input v-model="form.password_confirmation" id="password_confirmation" type="password" class="w-full" autocomplete="password_confirmation" />
					<form-error :message="validationErrors.password_confirmation" class="mt-2" />
				</div>
			</form-group>

		</template>

		<template #actions>
			<nuxt-link to="/admin/categories" class="xs:mr-4 text-sm">Cancel</nuxt-link>
			<form-button class="px-6" :class="{ 'opacity-50': isRequestProcessing }" :disabled="isRequestProcessing">Update</form-button>
		</template>
	</form-view>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "admin-change-password",
	layout: "admin",
	mixins: [form],
	data() {
		return {
			form: {
				oldPassword: null,
				password: null,
				password_confirmation: null,
			},
			breadcrumb: [
				{ label: "Home", route: "/admin/dashboard" },
				{ label: "Change Password", route: null },
			],
		};
	},

	methods: {
		async save() {
			try {
				const response = await this.$axios.$post(
					`/admin/change-password/`,
					this.form
				);
				this.$toast.success(response.message);
			} catch (error) {
				console.error(error);
			}
		},
	},
};
</script>

<style lang="scss" scoped>
</style>