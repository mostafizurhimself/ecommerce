<template>
	<div>
		<button @click.prevent="showDialog = true" class="w-full rounded-lg hover:bg-gray-100  py-2" v-if="type == 'multiple'">
			<span class="flex items-center ml-3 text-sm">
				<i class="ti-pencil-alt mr-2"></i>
				<span>Update Status</span>
			</span>
		</button>

		<button @click.prevent="showDialog = true" class="btn btn-success" type="button" v-if="type == 'single'">Update Status</button>

		<!-- Update status modal -->
		<dialog-modal :show="showDialog" @close="closeModal">
			<template #title>Update Status</template>

			<template #content>
				<!-- Status -->
				<div class="flex flex-col md:flex-row px-6 pb-4">
					<form-label class="md:w-1/4" for="status" value="Status" required />
					<div class="w-full">
						<form-select class="w-full" placeholder="Select Status" track="value" v-model="form.status" :options="orderStatus"></form-select>
						<form-error :message="validationErrors.status" class="mt-2" />
					</div>
				</div>
			</template>

			<template #footer>
				<button class="px-4" @click="closeModal">Cancel</button>
				<button class="ml-2 btn btn-success" :class="{ 'opacity-25': isRequestProcessing }" :disabled="isRequestProcessing" @click="update">Update</button>
			</template>
		</dialog-modal>
	</div>

</template>

<script>
import { mapGetters } from "vuex";
import form from "~/plugins/mixins/form";
export default {
	props: {
		ids: {
			type: Array,
			required: true,
		},
		type: {
			type: String,
			default: "multiple",
			validator: (value) => {
				return ["multiple", "single"].includes(value);
			},
		},
	},
	mixins: [form],
	computed: {
		...mapGetters({
			orderStatus: "global/getOrderStatus",
		}),
	},
	data() {
		return {
			showDialog: false,
			form: {
				ids: this.ids,
				status: null,
			},
		};
	},

	methods: {
		closeModal() {
			this.showDialog = false;
		},
		async update() {
			try {
				const response = await this.$axios.$post(
					"/admin/orders/update-status",
					this.form
				);
				this.showDialog = false;
				this.$toast.success(response.message);
				this.$emit("success");
			} catch (error) {
				console.error(error);
				this.showDialog = false;
			}
		},
	},
};
</script>

<style lang="scss" scoped>
</style>
