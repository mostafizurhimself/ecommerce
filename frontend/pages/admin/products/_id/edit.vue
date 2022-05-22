<template>
	<loader :loading="$fetchState.pending">
		<form-view @submitted="save" title="Edit Product" :breadcrumb="breadcrumb">
			<template #form>
				<!-- Category -->
				<form-group class="border-b">
					<form-label class="md:w-1/4 mt-2" for="categoryId" value="Category" required />
					<div class="w-full mt-1">
						<form-select :options="categories" v-model="form.categoryId" id="categoryId" class="w-full" autocomplete="categoryId" />
						<form-error :message="validationErrors.categoryId" class="mt-2" />
					</div>
				</form-group>

				<!-- Name -->
				<form-group class="border-b">
					<form-label class="md:w-1/4 mt-2" for="name" value="Name" required />
					<div class="w-full mt-1">
						<form-input v-model="form.name" id="name" type="text" class="w-full" autocomplete="name" />
						<form-error :message="validationErrors.name" class="mt-2" />
					</div>
				</form-group>

				<!-- SKU -->
				<form-group class="border-b">
					<form-label class="md:w-1/4 mt-2" for="sku" value="SKU" required />
					<div class="w-full mt-1">
						<form-input v-model="form.sku" id="sku" type="text" class="w-full" autocomplete="sku" />
						<form-error :message="validationErrors.sku" class="mt-2" />
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

				<!-- Price -->
				<form-group class="border-b">
					<form-label class="md:w-1/4 mt-2" for="price" value="Price" required />
					<div class="w-full mt-1">
						<form-input v-model="form.price" id="price" type="number" class="w-full" autocomplete="price" />
						<form-error :message="validationErrors.price" class="mt-2" />
					</div>
				</form-group>

				<!-- Quantity -->
				<form-group class="border-b">
					<form-label class="md:w-1/4 mt-2" for="quantity" value="Quantity" required />
					<div class="w-full mt-1">
						<form-input v-model="form.quantity" id="quantity" type="number" class="w-full" autocomplete="quantity" />
						<form-error :message="validationErrors.quantity" class="mt-2" />
					</div>
				</form-group>

				<!-- Unit -->
				<form-group class="border-b">
					<form-label class="md:w-1/4 mt-2" for="unitId" value="Unit" required />
					<div class="w-full mt-1">
						<form-select :options="units" v-model="form.unitId" id="unitId" class="w-full" autocomplete="unitId" />
						<form-error :message="validationErrors.unitId" class="mt-2" />
					</div>
				</form-group>

				<!-- Image -->
				<form-group>
					<form-label for="image" class="md:w-1/4 mt-2" value="Image" />
					<div class="w-full mt-1">
						<form-image-input :url="form.imageUrl" v-model="form.image"></form-image-input>
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
	</loader>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "admin-product-edit",
	layout: "admin",
	mixins: [form],
	data() {
		return {
			form: {
				categoryId: null,
				name: null,
				sku: null,
				description: null,
				price: null,
				quantity: null,
				image: null,
			},
			categories: [],
			units: [],
			breadcrumb: [
				{ label: "Home", route: "/admin/dashboard" },
				{ label: "Products", route: "/admin/products" },
				{
					label: this.$route.params.id,
					route: `/admin/products/${this.$route.params.id}`,
				},
				{ label: "Edit", route: null },
			],
		};
	},

	methods: {
		async save(event, saveAndContinue = false) {
			try {
				const response = await this.$axios.$put(
					`/admin/products/${this.form.id}`,
					this.form
				);
				this.$toast.success(response.message);
				if (!saveAndContinue) {
					this.$router.push("/admin/products");
				}
			} catch (error) {
				console.error(error);
			}
		},
	},
	async fetch() {
		const product = await this.$axios.$get(
			`/admin/products/${this.$route.params.id}`
		);
		const categories = await this.$axios.$get("/admin/categories");
		const units = await this.$axios.$get("/admin/units");
		this.setValues(this.form, product.data);
		this.categories = categories.data;
		this.units = units.data;
	},
};
</script>

<style lang="scss" scoped>
</style>