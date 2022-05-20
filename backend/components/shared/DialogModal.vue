<template>
	<modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
		<div>
			<div class="text-lg font-semibold px-6 py-4 bg-gray-50">
				<slot name="title">
				</slot>
			</div>

			<div class="mt-4">
				<slot name="content">
				</slot>
			</div>
		</div>

		<div class="px-6 py-4 bg-gray-50 text-right">
			<slot name="footer">
			</slot>
		</div>
	</modal>
</template>

<script>
export default {
	emits: ["close"],

	props: {
		show: {
			default: false,
		},
		maxWidth: {
			default: "2xl",
		},
		closeable: {
			default: true,
		},
	},

	methods: {
		close() {
			this.$emit("close");
		},
	},
};
</script>
