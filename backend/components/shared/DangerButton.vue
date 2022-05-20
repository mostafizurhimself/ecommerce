<template>
	<button v-if="type !== 'submit'" @click.prevent="$emit('click')" :type="type" :disabled="disabled" class="inline-flex items-center justify-center px-4 py-2 bg-red-500 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
		<slot></slot>
	</button>
	<button v-else :type="type" :disabled="disabled" class="inline-flex items-center justify-center px-4 py-2 bg-red-500 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
		<slot></slot>
	</button>
</template>

<script>
export default {
	props: {
		type: {
			type: String,
			default: "button",
		},
		disabled: {
			type: Boolean,
			default: false,
		},
	},
};
</script>
