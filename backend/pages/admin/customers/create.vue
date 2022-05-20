<template>
	<form-view @submitted="save" title="Create Customer" :breadcrumb="breadcrumb">
		<template #form>

			<!-- Name -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="name" value="Name" required />
				<div class="w-full mt-1">
					<form-input v-model="form.name" id="name" type="text" class="w-full" autocomplete="name" />
					<form-error :message="validationErrors.name" class="mt-2" />
				</div>
			</form-group>

			<!-- Email -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="email" value="Email" required />
				<div class="w-full mt-1">
					<form-input v-model="form.email" id="email" type="email" class="w-full" autocomplete="email" />
					<form-error :message="validationErrors.email" class="mt-2" />
				</div>
			</form-group>

			<!-- Phone -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="phone" value="Phone" required />
				<div class="w-full mt-1">
					<form-input v-model="form.phone" id="phone" type="text" class="w-full" autocomplete="phone" />
					<small class="mt-1 text-gray-400 text-xs">* Phone number format should be 01XXXXXXXXX.</small>
					<form-error :message="validationErrors.phone" class="mt-2" />
				</div>
			</form-group>

			<!-- Password -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="password" value="Password" required />
				<div class="w-full mt-1">
					<form-input v-model="form.password" id="password" type="password" class="w-full" autocomplete="password" />
					<form-error :message="validationErrors.password" class="mt-2" />
				</div>
			</form-group>

			<!-- Confirm Password -->
			<form-group class="border-b">
				<form-label class="md:w-1/4 mt-2" for="password_confirmation" value="Confirm Password" required />
				<div class="w-full mt-1">
					<form-input v-model="form.password_confirmation" id="password_confirmation" type="password" class="w-full" autocomplete="password_confirmation" />
					<form-error :message="validationErrors.password" class="mt-2" />
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
			<nuxt-link to="/admin/products" class="xs:mr-4 text-sm">Cancel</nuxt-link>
			<form-button type="button" @click="save($event, true)" class="px-6 xs:mr-2 my-2 xs:my-0" :class="{ 'opacity-50': isRequestProcessing }" :disabled="isRequestProcessing">Save & Continue</form-button>
			<form-button class="px-6" :class="{ 'opacity-50': isRequestProcessing }" :disabled="isRequestProcessing">Save</form-button>
		</template>
	</form-view>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "admin-customer-create",
	layout: "admin",
	mixins: [form],
	data() {
		return {
			form: {
				name: null,
				email: null,
				phone: null,
				password: null,
				password_confirmation: null,
				image: null,
			},
			breadcrumb: [
				{ label: "Home", route: "/admin/dashboard" },
				{ label: "Customers", route: "/admin/customers" },
				{ label: "Create", route: null },
			],
		};
	},

	methods: {
		async save(event, saveAndContinue = false) {
			try {
				const response = await this.$axios.$post(
					"/admin/customers",
					this.form
				);
				this.$toast.success(response.message);
				if (saveAndContinue) {
					this.reset("form");
				} else {
					this.$router.push("/admin/customers");
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