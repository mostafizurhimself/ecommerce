<template>
	<nuxt-link :to="to" class="inline-flex whitespace-nowrap items-center justify-center bg-primary-500 hover:bg-primary-600 focus:bg-primary-700 text-white px-4 py-2 shadow-md border border-transparent rounded-full text-sm transition">
		<slot class="mr-2" name="icon"></slot>
		<slot></slot>
	</nuxt-link>
</template>

<script>
export default {
	props: {
		to: {
			type: String,
			required: true,
		},
	},
};
</script>

