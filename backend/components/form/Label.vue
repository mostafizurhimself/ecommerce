<template>
	<label class="block text-gray-900">
		<p class="text-sm font-medium" v-if="value">{{ value }} <span v-if="required !== false" class="text-red-500">*</span></p>
		<span v-else>
			<slot></slot>
		</span>
	</label>
</template>

<script>
export default {
	props: {
		value: {
			type: String,
			default: "",
		},
		required: {
			type: [Boolean],
			default: false,
		},
	},
};
</script>
