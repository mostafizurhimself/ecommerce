<template>
	<div>
		<data-table :columns="columns" url="/orders" :disableCheck="true" :showIndex="true" :filters="filters">
			<!-- Search -->
			<template #search>
				<form-search v-model="filters.search"></form-search>
			</template>

			<!-- Filters -->
			<template #filter>
				<status-filter v-model="filters.status" :options="orderStatusOptions"></status-filter>
				<page-filter v-model="filters.perPage" class="mt-4"></page-filter>
				<!-- Reset filter -->
				<div class="w-full text-center mt-4">
					<button type="button" @click="resetFilter" class="text-primary-500 hover:font-medium tracking-wider hover:underline text-sm">Reset Filter</button>
				</div>
			</template>

			<!-- Invoice Column -->
			<template #invoiceNo="{row}">
				<nuxt-link :to="`/customer/orders/${row.id}`" class="tracking-widest text-primary-500">{{row.invoiceNo}}</nuxt-link>
			</template>

			<!-- Status Column -->
			<template #status={col}>
				<badge :value="col"></badge>
			</template>

			<!-- Row Actions -->
			<template #action="{ row }">
				<nuxt-link class="btn btn-success mr-2" :to="`/customer/orders/${row.id}`">
					<detail-icon></detail-icon>
				</nuxt-link>

			</template>
		</data-table>
	</div>

</template>

<script>
import form from "~/plugins/mixins/form";
import { mapGetters } from "vuex";
export default {
	name: "customer-orders",
	mixins: [form],
	data() {
		return {
			columns: [
				{ label: "Invoice", field: "invoiceNo" },
				{ label: "Date", field: "dateFormatted" },
				{ label: "Total", field: "grandTotalFormatted" },
				"status",
			],
			filters: {
				search: "",
				perPage: 25,
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

