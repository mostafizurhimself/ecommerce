<template>
	<div>
		<form-label class="mb-2 font-semibold" for="page-filter" value="Per Page"></form-label>
		<form-select id="page-filter" class="w-full" :options="perPageOptions" :value="value" @input="handleInput" :showPlaceholder="false" track="value" title="label"></form-select>
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
	},
	data() {
		return {
			perPageOptions: [
				{ value: 10, label: "10" },
				{ value: 25, label: "25" },
				{ value: 50, label: "50" },
				{ value: 100, label: "100" },
			],
		};
	},

	methods: {
		handleInput(value) {
			// console.log(value);
			this.$emit("input", value);
		},
	},
};
</script>

<style lang="scss" scoped>
</style>
