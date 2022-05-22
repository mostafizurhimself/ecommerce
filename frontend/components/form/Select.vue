<template>
	<select :class="{'py-3' : variant == 'normal', 'py-2' : variant == 'small'}" class="px-4 text-sm border border-gray-300 focus:outline-none focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-full shadow-sm" :value="value" @input="$emit('input', $event.target.value)" :disabled="disabled">
		<option value="" v-if="showPlaceholder">{{ placeholder }}</option>
		<option :selected="option['track']" :value="option[track]" v-for="(option, i) in options" :key="i">
			{{option[title]}}
		</option>
	</select>
</template>

<script>
export default {
	props: {
		// Value by v-model directive
		value: {
			type: [String, Number],
			default: "",
		},
		// Select options
		options: {
			type: [Array, Object],
			default: () => [],
		},
		// Return value for v-model
		track: {
			type: String,
			default: "id",
		},
		// Placeholder
		placeholder: {
			type: String,
			default: "Select One",
		},
		// Disabled
		disabled: {
			type: Boolean,
			default: false,
		},
		// Which property to show on option
		title: {
			type: String,
			default: "name",
		},
		// Control select placeholder
		showPlaceholder: {
			type: Boolean,
			default: true,
		},

		variant: {
			type: String,
			default: "normal",
			validator: (value) => {
				return ["normal", "small"].includes(value);
			},
		},
	},

	emits: ["input"],
};
</script>

