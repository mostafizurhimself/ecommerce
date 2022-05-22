<template>
	<index-view title="Orders" :breadcrumb="breadcrumb">
		<data-table :columns="columns" url="/admin/orders" :filters="filters">
			<!-- Search -->
			<template #search>
				<form-search v-model="filters.search"></form-search>
			</template>

			<!-- Actions -->
			<template #bulk-action="{ids, getData}">
				<update-order-status :ids="ids" @success="getData()"></update-order-status>
				<mark-as-delivered :ids="ids" @success="getData()"></mark-as-delivered>
			</template>

			<!-- Filters -->
			<template #filter>
				<status-filter v-model="filters.status" :options="orderStatusOptions"></status-filter>
				<page-filter v-model="filters.perPage" class="mt-4"></page-filter>
				<trash-filter class="mt-4" v-model="filters.trashed"></trash-filter>
				<!-- Reset filter -->
				<div class="w-full text-center mt-4">
					<button type="button" @click="resetFilter" class="text-primary-500 hover:font-medium tracking-wider hover:underline text-sm">Reset Filter</button>
				</div>
			</template>

			<!-- Invoice Column -->
			<template #invoiceNo="{row}">
				<nuxt-link :to="`/admin/orders/${row.id}`" class="tracking-widest text-primary-500">{{row.invoiceNo}}</nuxt-link>
			</template>

			<!-- Status Column -->
			<template #status={col}>
				<badge :value="col"></badge>
			</template>

			<!-- Row Actions -->
			<template #action="{ row }">
				<nuxt-link class="btn btn-success mr-2" :to="`/admin/orders/${row.id}`">
					<detail-icon></detail-icon>
				</nuxt-link>

			</template>
		</data-table>
	</index-view>
</template>

<script>
import form from "~/plugins/mixins/form";
import { mapGetters } from "vuex";
export default {
	layout: "admin",
	mixins: [form],
	data() {
		return {
			breadcrumb: [
				{ label: "Home", route: "admin/dashboard" },
				{ label: "Orders", route: null },
			],

			columns: [
				"id",
				{ label: "Invoice", field: "invoiceNo" },
				{ label: "Date", field: "dateFormatted" },
				{ label: "Customer", field: "customer.name" },
				{ label: "Total", field: "grandTotalFormatted" },
				"status",
			],
			filters: {
				search: "",
				perPage: 25,
				trashed: "",
				status: "",
			},
		};
	},
	computed: {
		...mapGetters({
			orderStatusOptions: "global/getAllOrderStatus",
		}),
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