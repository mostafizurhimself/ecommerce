<template>
	<form-view @submitted="save" title="Update Profile" :breadcrumb="breadcrumb">
		<template #form>
			<!-- Name -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="name" value="Name" required />
				<div class="w-full mt-1">
					<form-input v-model="form.name" id="name" type="text" class="w-full" autocomplete="name" />
					<form-error :message="validationErrors.name" class="mt-2" />
				</div>
			</form-group>

			<!--  Email -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="email" value=" Email" />
				<div class="w-full">
					<form-input v-model="form.email" id="email" type="text" class="w-full" autocomplete="email" />
					<form-error :message="validationErrors.email" class="mt-2" />
				</div>

			</form-group>

			<!-- Photo -->
			<form-group>
				<form-label for="photo" class="md:w-1/4 mt-2" value="Photo" />
				<div class="w-full mt-1">
					<form-image-input :url="$auth.user.profilePhotoUrl" v-model="form.photo"></form-image-input>
					<small class="mt-1 text-gray-400 text-xs">* Image should be 1:1 acpect ratio. Maximum file size: 5MB/5120KB.</small>
					<form-error :message="validationErrors.photo" class="mt-2" />
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
	name: "admin-profile",
	layout: "admin",
	mixins: [form],
	data() {
		return {
			form: {
				name: this.$auth.user.name,
				email: this.$auth.user.email,
				photo: null,
			},
			breadcrumb: [
				{ label: "Home", route: "/admin/dashboard" },
				{ label: "Profile", route: null },
			],
		};
	},

	methods: {
		async save() {
			try {
				const response = await this.$axios.$post(
					`/admin/profile/`,
					this.form
				);
				this.$toast.success(response.message);
				this.$auth.setUser(response.data.user);
			} catch (error) {
				console.error(error);
			}
		},
	},
};
</script>

<style lang="scss" scoped>
</style>