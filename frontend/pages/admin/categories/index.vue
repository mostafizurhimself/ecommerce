<template>
	<index-view title="Categories" :breadcrumb="breadcrumb">
		<data-table :columns="columns" url="/admin/categories" :filters="filters" :disableCheck="true">
			<!-- Category Image -->
			<template #image={row}>
				<div class="w-10 h-10">
					<img :src="row.primaryMediaUrl" class="w-100 object-cover">
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
				<button-link class="px-6 py-3" to="/admin/categories/create">
					<span class="mr-2">+ Add</span>
					<span class="hidden sm:inline">Category</span>
				</button-link>
			</template>

			<!-- Table row actions -->
			<template #action="{ row, remove, index }">
				<nuxt-link class="btn btn-primary" :to="`/admin/categories/${row.id}/edit`">
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
				{ label: "Categories", route: null },
			],

			columns: ["id", "image", "name", "description"],
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