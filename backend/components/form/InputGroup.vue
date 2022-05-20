<template>
	<div v-if="variant == 'prepend'" class="flex flex-nowrap items-stretch w-full relative rounded-full overflow-hidden border border-gray-300 focus-within:border-primary-300 focus-within:outline-none focus-within:ring focus-within:ring-primary-200 focus-within:ring-opacity-50">
		<div class="flex -mr-px bg-gray-200">
			<span class="w-10 flex items-center justify-center leading-normal whitespace-no-wrap text-grey-dark text-xs font-semibold uppercase">
				<slot>
					<span>{{label}}</span>
				</slot>
			</span>
		</div>
		<input :type="type" @blur="$emit('blur', $event.target.value)" @input="$emit('input', $event.target.value)" :value="value" class="flex-shrink flex-grow leading-normal w-px flex-1 h-6 rounded rounded-l-none px-3 relative focus:outline-none" :placeholder="placeholder">
	</div>

	<div v-else class="flex flex-nowrap items-stretch w-full relative rounded-full overflow-hidden border border-gray-300 focus-within:border-primary-300 focus-within:outline-none focus-within:ring focus-within:ring-primary-200 focus-within:ring-opacity-50">
		<input :type="type" @blur="$emit('blur', $event.target.value)" @input="$emit('input', $event.target.value)" :value="value" class="flex-shrink flex-grow leading-normal w-px flex-1 h-6 px-3 relative focus:outline-none" :placeholder="placeholder">
		<div class="flex -mr-px bg-gray-200">
			<span class="flex items-center leading-normal px-3 whitespace-no-wrap text-grey-dark text-xs font-semibold uppercase">
				<slot>
					<span>{{label}}</span>
				</slot>
			</span>
		</div>
	</div>
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
			default: "prepend",
			validator: (value) => {
				return ["append", "prepend"].includes(value);
			},
		},
		label: {
			type: [String, Number],
			default: "",
		},
		placeholder: {
			type: [String, Number],
			default: "",
		},
	},
};
</script>

<style lang="scss" scoped>
</style>