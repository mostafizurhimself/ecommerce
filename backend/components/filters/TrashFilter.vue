<template>
	<div>
		<form-label class="mb-2 font-semibold" for="page-filter" value="Trashed"></form-label>
		<form-select class="w-full" :options="options" :value="value" @input="handleInput" :showPlaceholder="false" track="value" title="label">
		</form-select>
	</div>
</template>

<script>
export default {
	props: {
		/**
		 * Default selected value
		 */
		value: {
			default: "",
		},
	},
	data() {
		return {
			options: [
				{ value: "", label: "Without Trashed" },
				{ value: "with", label: "With Trashed" },
				{ value: "only", label: "Only Trashed" },
			],
		};
	},

	methods: {
		handleInput(value) {
			this.$emit("input", value);
		},
	},
};
</script>

<style lang="scss" scoped></style>
