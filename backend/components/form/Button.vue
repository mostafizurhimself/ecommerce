<template>
	<button v-if="type !== 'submit'" @click.prevent="$emit('click')" :type="type" :disabled="disabled" class="inline-flex items-center justify-center px-6 py-2 bg-primary-500 border border-transparent rounded-full text-sm text-white hover:bg-primary-600 active:bg-primary-700 focus:outline-none focus:border-primary-700 focus:ring focus:ring-primary-200 transition whitespace-nowrap">
		<slot></slot>
	</button>

	<button v-else :type="type" :disabled="disabled" class="inline-flex items-center justify-center px-6 py-2 bg-primary-500 border border-transparent rounded-full text-sm text-white hover:bg-primary-600 active:bg-primary-700 focus:outline-none focus:border-primary-700 focus:ring focus:ring-primary-200 transition whitespace-nowrap">
		<slot></slot>
	</button>
</template>

<script>
export default {
	props: {
		type: {
			type: String,
			default: "submit",
			validator: (value) => {
				return ["submit", "button"].includes(value);
			},
		},
		disabled: {
			type: Boolean,
			default: false,
		},
	},
};
</script>
