<template>
	<input :class="{'py-3' : variant == 'normal', 'py-2' : variant == 'small'}" :type="type" @blur="$emit('blur', $event.target.value)" @input="$emit('input', $event.target.value)" :value="value" class="px-4 text-sm rounded-full border border-gray-300 focus:border-primary-300 focus:outline-none focus:ring focus:ring-primary-200 focus:ring-opacity-50 shadow-sm">
</template>

<script>
export default {
	props: {
		value: {
			type: [Number, String],
			default: null,
		},
		type: {
			type: String,
			default: "text",
			validator: (value) => {
				return [
					"text",
					"email",
					"number",
					"date",
					"password",
					"month",
					"tel",
				].includes(value);
			},
		},
		variant: {
			type: String,
			default: "normal",
			validator: (value) => {
				return ["normal", "small"].includes(value);
			},
		},
	},
};
</script>

<style lang="scss" scoped>
</style>