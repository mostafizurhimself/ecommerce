<template>
	<index-view title="Deliveries" :breadcrumb="breadcrumb">
		<data-table :columns="columns" url="/admin/deliveries" :disableCheck="true" :filters="filters">
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

			<!-- Invoice Column -->
			<template #invoiceNo="{row}">
				<nuxt-link :to="`/admin/deliveries/${row.id}`" class="tracking-widest text-primary-500">{{row.invoiceNo}}</nuxt-link>
			</template>

			<!-- Row Actions -->
			<template #action="{ row }">
				<nuxt-link class="btn btn-success mr-2" :to="`/admin/deliveries/${row.id}`">
					<detail-icon></detail-icon>
				</nuxt-link>
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
				{ label: "Deliveries", route: null },
			],

			columns: [
				"id",
				{ label: "Invoice", field: "invoiceNo" },
				{ label: "Date", field: "dateFormatted" },
				{ label: "Customer", field: "customer.name" },
				{ label: "Total", field: "grandTotalFormatted" },
			],
			filters: {
				search: "",
				perPage: 25,
				trashed: "",
				status: "",
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