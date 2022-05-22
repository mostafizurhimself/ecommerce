<template>
	<form-view @submitted="save" title="Create Category" :breadcrumb="breadcrumb">
		<template #form>
			<!-- Name -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="name" value="Name" required />
				<div class="w-full mt-1">
					<form-input v-model="form.name" id="name" type="text" class="w-full" autocomplete="name" />
					<form-error :message="validationErrors.name" class="mt-2" />
				</div>
			</form-group>

			<!--  Description -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="name" value=" Description" />
				<div class="w-full">
					<form-text-input v-model="form.description" id="name" type="text" class="mt-1 block w-full" autocomplete="name" />
					<form-error :message="validationErrors.description" class="mt-2" />
				</div>

			</form-group>

			<!-- Image -->
			<form-group>
				<form-label for="image" class="md:w-1/4 mt-2" value="Image" />
				<div class="w-full mt-1">
					<form-image-input v-model="form.image"></form-image-input>
					<small class="mt-1 text-gray-400 text-xs">* Image should be 1:1 acpect ratio. Maximum file size: 5MB/5120KB.</small>
					<form-error :message="validationErrors.image" class="mt-2" />
				</div>
			</form-group>

		</template>

		<template #actions>
			<nuxt-link to="/admin/categories" class="xs:mr-4 text-sm">Cancel</nuxt-link>
			<form-button type="button" @click="save($event, true)" class="px-6 xs:mr-2 my-2 xs:my-0" :class="{ 'opacity-50': isRequestProcessing }" :disabled="isRequestProcessing">Save & Continue</form-button>
			<form-button class="px-6" :class="{ 'opacity-50': isRequestProcessing }" :disabled="isRequestProcessing">Save</form-button>
		</template>
	</form-view>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "admin-category-create",
	layout: "admin",
	mixins: [form],
	data() {
		return {
			form: {
				name: null,
				description: null,
				image: null,
			},
			breadcrumb: [
				{ label: "Home", route: "/admin/dashboard" },
				{ label: "Categories", route: "/admin/categories" },
				{ label: "Create", route: null },
			],
		};
	},

	methods: {
		async save(event, saveAndContinue = false) {
			try {
				const response = await this.$axios.$post(
					`/admin/categories/`,
					this.form
				);
				this.$toast.success(response.message);

				if (saveAndContinue) {
					this.reset("form");
				} else {
					this.$router.push("/admin/categories");
				}
			} catch (error) {
				console.error(error);
			}
		},
	},
};
</script>

<style lang="scss" scoped>
</style>