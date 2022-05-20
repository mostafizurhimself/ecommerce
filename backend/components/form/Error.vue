<template>
	<div v-show="message">
		<p class="text-sm text-red-600 font-light">
			{{ message[0] }}
		</p>
	</div>
</template>

<script>
export default {
	props: {
		message: {
			type: Array,
			default: () => [],
		},
	},
};
</script>
