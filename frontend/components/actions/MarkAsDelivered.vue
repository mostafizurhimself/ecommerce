<template>
	<div>
		<button @click.prevent="mardAsDelivered" class="w-full rounded-lg hover:bg-gray-100  py-2" v-if="type == 'multiple'">
			<span class="flex items-center ml-3 text-sm">
				<i class="ti-truck mr-2"></i>
				<span>Mark As Delivered</span>
			</span>
		</button>

		<button @click.prevent="mardAsDelivered" class="btn btn-danger" type="button" v-if="type == 'single'">Mark As Delivered</button>
	</div>

</template>

<script>
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
	methods: {
		async mardAsDelivered() {
			this.$swal
				.fire({
					title: "Are you sure?",
					text: "You won't be able to revert this!",
					icon: "warning",
					confirmButtonColor: "#8b5cf6",
					showCancelButton: true,
					confirmButtonText: "Yes, do it!",
				})
				.then(async (result) => {
					if (result.isConfirmed) {
						try {
							const response = await this.$axios.$post(
								"/admin/orders/mark-as-delivered",
								{ ids: this.ids }
							);
							this.showDialog = false;
							this.$toast.success(response.message);
							this.$emit("success");
						} catch (error) {
							// this.$toast.error("Sorry, operation failed");
							console.error(error);
						}
					}
				});
		},
	},
};
</script>

<style lang="scss" scoped>
</style>
