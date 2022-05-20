<template>
	<index-view title="Customers" :breadcrumb="breadcrumb">
		<data-table :columns="columns" url="/admin/customers" :filters="filters" :disableCheck="true">
			<template #image={row}>
				<div class="w-10 h-10">
					<img :src="row.profilePhotoUrl" class="w-100 object-cover">
				</div>
			</template>
			<!-- Search -->
			<template #search>
				<form-search v-model="filters.search"></form-search>
			</template>

			<!-- Filters -->
			<template #filter>
				<page-filter v-model="filters.perPage"></page-filter>
				<trash-filter class="mt-4" v-model="filters.trashed"></trash-filter>
				<!-- Reset filter -->
				<div class="w-full text-center mt-4">
					<button type="button" @click="resetFilter" class="text-primary-500 hover:font-medium tracking-wider hover:underline text-sm">Reset Filter</button>
				</div>
			</template>

			<!-- Add Button -->
			<template #button>
				<button-link class="px-6 py-3" to="/admin/customers/create">
					<span class="mr-2">+ Add</span>
					<span class="hidden md:inline">Customer</span>
				</button-link>
			</template>

			<!-- Row Actions -->
			<template #action="{ row, remove, index }">
				<nuxt-link class="btn btn-success mr-2" :to="`/admin/customers/${row.id}`">
					<detail-icon></detail-icon>
				</nuxt-link>

				<nuxt-link class="btn btn-primary" :to="`/admin/customers/${row.id}/edit`">
					<i class="ti-pencil-alt"></i>
				</nuxt-link>

				<danger-button class="ml-2" @click="remove(row.id, index)">
					<i class="ti-trash"></i>
				</danger-button>
			</template>
		</data-table>
	</index-view>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	layout: "admin",
	mixins: [form],
	data() {
		return {
			breadcrumb: [
				{ label: "Home", route: "admin/dashboard" },
				{ label: "Customers", route: null },
			],

			columns: ["id", "image", "name", "email", "phone"],
			filters: {
				search: "",
				perPage: 25,
				trashed: "",
			},
		};
	},

	methods: {
		resetFilter() {
			this.reset("filters");
		},
	},
};
</script>

<style lang="scss" scoped>
</style>