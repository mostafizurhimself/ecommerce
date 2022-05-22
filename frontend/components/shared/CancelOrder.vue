<template>
	<div>
		<button class="btn btn-danger" @click="showDialog = true">Cancel Order</button>

		<!-- Update status modal -->
		<dialog-modal :show="showDialog" @close="closeModal">
			<template #title>Cancel Reason</template>

			<template #content>
				<!-- Status -->
				<div class="flex flex-col md:flex-row px-6 pb-4">
					<form-label class="md:w-1/4 mb-2" for="status" value="Status" required />
					<div class="w-full">
						<form-text-input class="w-full" placeholder="Reason" track="value" v-model="form.reason"></form-text-input>
						<form-error :message="validationErrors.reason" class="mt-2" />
					</div>
				</div>
			</template>

			<template #footer>
				<button class="px-4 text-sm" @click="closeModal">Cancel</button>
				<button class="ml-2 btn btn-danger" :class="{ 'opacity-25': isRequestProcessing }" :disabled="isRequestProcessing" @click="cancelOrder">Submit</button>
			</template>
		</dialog-modal>
	</div>

</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	props: {
		order: {
			type: Object,
			required: true,
		},
	},
	data() {
		return {
			showDialog: false,
			form: {
				reason: null,
			},
		};
	},
	mixins: [form],
	methods: {
		closeModal() {
			this.showDialog = false;
		},
		async cancelOrder() {
			try {
				const response = await this.$axios.$post(
					`/orders/${this.order.id}/cancel`,
					this.form
				);
				this.showDialog = false;
				this.$emit("success", response.data.order);
				this.$toast.success(response.message);
			} catch (error) {
				this.$toast.error("Sorry, operation failed!");
				console.error(error);
			}
		},
	},
};
</script>

<style lang="scss" scoped>
</style>
