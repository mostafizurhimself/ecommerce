<template>
	<div>
		<form-label class="mb-2 font-semibold" for="status-filter" value="Status"></form-label>
		<form-select id="status-filter" class="w-full" :options="options" :value="value" @input="handleInput" placeholder="Select Status" track="value"></form-select>
	</div>
</template>

<script>
export default {
	props: {
		/**
		 * Default selected value
		 */
		value: {
			type: [Number, String],
			default: 25,
		},

		/**
		 * Get the status options
		 */
		options: {
			type: Array,
			default: () => [],
		},
	},
	methods: {
		handleInput(value) {
			this.$emit("input", value);
		},
	},
};
</script>

<style lang="scss" scoped>
</style>
